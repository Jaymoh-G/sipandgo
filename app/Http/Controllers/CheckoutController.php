<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use App\Services\MpesaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    protected $cartService;
    protected $mpesaService;

    public function __construct(CartService $cartService, MpesaService $mpesaService)
    {
        $this->cartService = $cartService;
        $this->mpesaService = $mpesaService;
    }

    /**
     * Display checkout page
     */
    public function index()
    {
        $items = $this->cartService->getItemsWithProducts();

        if (empty($items)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $subtotal = $this->cartService->getSubtotal();
        $taxRate = 0.10; // 10% tax rate
        $taxAmount = round($subtotal * $taxRate, 2);
        $shippingAmount = 10.00; // Fixed shipping
        $total = round($subtotal + $taxAmount + $shippingAmount, 2);

        return view('storefront.checkout.index', compact('items', 'subtotal', 'taxAmount', 'shippingAmount', 'total'));
    }

    /**
     * Process checkout
     */
    public function store(Request $request)
    {
        // Validate cart is not empty
        $items = $this->cartService->getItemsWithProducts();
        if (empty($items)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'mpesa_number' => ['required', 'string', 'regex:/^(?:\+?254|0)?7\d{8}$/'],
            'delivery_address' => ['nullable', 'string', 'max:500'],
        ]);

        $subtotal = $this->cartService->getSubtotal();
        $taxAmount = round($subtotal * 0.10, 2);
        $shippingAmount = 10.00;
        $totalAmount = round($subtotal + $taxAmount + $shippingAmount, 2);

        $formattedPhone = $this->formatPhoneNumber($validated['mpesa_number']);
        $orderNumber = 'SIP' . now()->format('YmdHis') . rand(1000, 9999);

        try {
            DB::beginTransaction();

            // Get or create customer
            $customer = $this->getOrCreateCustomer($formattedPhone, $validated['delivery_address'] ?? null);

            // Create order
            $order = Order::create([
                'customer_id' => $customer->id,
                'order_number' => $orderNumber,
                'status' => 'pending',
                'subtotal' => $subtotal,
                'tax_amount' => $taxAmount,
                'shipping_amount' => $shippingAmount,
                'discount_amount' => 0,
                'total_amount' => $totalAmount,
                'currency' => 'KES',
                'payment_status' => 'pending',
                'payment_method' => 'mpesa',
                'notes' => $validated['delivery_address'] ?? null,
                'billing_address' => [
                    'phone' => $formattedPhone,
                ],
                'shipping_address' => [
                    'address' => $validated['delivery_address'] ?? null,
                    'phone' => $formattedPhone,
                ],
            ]);

            // Create order items
            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']->id,
                    'product_name' => $item['product']->name,
                    'product_sku' => $item['product']->sku ?? 'N/A',
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $item['total'],
                ]);
            }

            // Send STK push
            $response = $this->mpesaService->stkPush(
                $formattedPhone,
                $totalAmount,
                $orderNumber,
                $validated['delivery_address'] ?? null
            );

            if (!$response['success']) {
                DB::rollBack();
                return back()->withInput()->with('error', $response['message'] ?? 'Failed to initiate M-Pesa STK push.');
            }

            // Store checkout request ID in order notes for callback tracking
            $order->update([
                'notes' => ($order->notes ? $order->notes . "\n" : '') .
                          "CheckoutRequestID: " . ($response['checkout_request_id'] ?? 'N/A'),
            ]);

            DB::commit();

            return redirect()->route('checkout')->with('success', $response['customer_message'] ?? 'STK push sent. Please complete payment on your phone.');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Checkout STK push error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            return back()->withInput()->with('error', 'Unable to initiate payment. Please try again.');
        }
    }

    /**
     * Handle M-Pesa callback
     */
    public function callback(Request $request)
    {
        try {
            $data = $request->json()->all();

            Log::info('M-Pesa Callback received', ['data' => $data]);

            if (!isset($data['Body']['stkCallback'])) {
                Log::warning('Invalid M-Pesa callback structure', ['data' => $data]);
                return response()->json(['ResultCode' => 1, 'ResultDesc' => 'Invalid callback structure'], 400);
            }

            $callback = $data['Body']['stkCallback'];
            $checkoutRequestId = $callback['CheckoutRequestID'] ?? null;
            $resultCode = $callback['ResultCode'] ?? null;
            $resultDesc = $callback['ResultDesc'] ?? '';

            // Find order by checkout request ID from notes
            $order = null;
            if ($checkoutRequestId) {
                // Search orders by checkout request ID in notes
                $order = Order::where('notes', 'like', "%CheckoutRequestID: {$checkoutRequestId}%")
                    ->where('payment_status', 'pending')
                    ->first();
            }

            if (!$order) {
                Log::warning('Order not found for checkout request', ['checkout_request_id' => $checkoutRequestId]);
                return response()->json(['ResultCode' => 1, 'ResultDesc' => 'Order not found'], 404);
            }

            if ($resultCode == 0) {
                // Payment successful
                $callbackMetadata = $callback['CallbackMetadata']['Item'] ?? [];
                $metadata = [];
                foreach ($callbackMetadata as $item) {
                    $metadata[$item['Name']] = $item['Value'] ?? null;
                }

                $order->update([
                    'payment_status' => 'paid',
                    'status' => 'processing',
                    'notes' => ($order->notes ? $order->notes . "\n" : '') .
                              "M-Pesa Receipt: " . ($metadata['MpesaReceiptNumber'] ?? 'N/A') . "\n" .
                              "Transaction Date: " . ($metadata['TransactionDate'] ?? 'N/A'),
                ]);

                // Clear cart
                $this->cartService->clear();

                Log::info('Payment successful', [
                    'order_id' => $order->id,
                    'receipt' => $metadata['MpesaReceiptNumber'] ?? null,
                ]);
            } else {
                // Payment failed
                $order->update([
                    'payment_status' => 'failed',
                    'notes' => ($order->notes ? $order->notes . "\n" : '') .
                              "Payment Failed: " . $resultDesc,
                ]);

                Log::warning('Payment failed', [
                    'order_id' => $order->id,
                    'result_code' => $resultCode,
                    'result_desc' => $resultDesc,
                ]);
            }

            return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Callback processed successfully']);
        } catch (\Throwable $e) {
            Log::error('M-Pesa callback error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['ResultCode' => 1, 'ResultDesc' => 'Callback processing failed'], 500);
        }
    }

    /**
     * Get or create customer for checkout
     */
    protected function getOrCreateCustomer(string $phone, ?string $address = null)
    {
        // If user is authenticated, use their customer record
        if (Auth::guard('customer')->check()) {
            return Auth::guard('customer')->user();
        }

        // For guest checkout, create or find a customer by phone
        $customer = Customer::where('phone', $phone)->first();

        if (!$customer) {
            // Create guest customer
            $customer = Customer::create([
                'first_name' => 'Guest',
                'last_name' => 'Customer',
                'email' => 'guest_' . $phone . '@sipandgo.local',
                'phone' => $phone,
                'date_of_birth' => now()->subYears(18),
                'age_verified' => true,
                'age_verified_at' => now(),
                'is_active' => true,
                'email_verified' => false,
                'address_line_1' => $address,
            ]);
        }

        return $customer;
    }

    /**
     * Display order success page
     */
    public function success(string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->with(['customer', 'items.product'])
            ->firstOrFail();

        return view('storefront.checkout.success', compact('order'));
    }

    protected function formatPhoneNumber(string $number): string
    {
        $digits = preg_replace('/\D+/', '', $number);

        if ($digits === null || $digits === '') {
            throw new \InvalidArgumentException('Invalid phone number.');
        }

        if (str_starts_with($digits, '0')) {
            $digits = '254' . substr($digits, 1);
        } elseif (str_starts_with($digits, '7')) {
            $digits = '254' . $digits;
        } elseif (str_starts_with($digits, '254')) {
            // Already in correct format
        } else {
            throw new \InvalidArgumentException('Invalid phone number format.');
        }

        return $digits;
    }
}

