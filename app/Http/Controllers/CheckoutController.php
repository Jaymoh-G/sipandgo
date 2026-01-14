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

        // Validate minimum amount (M-Pesa requires at least 1 KES)
        if ($totalAmount < 1) {
            return back()->withInput()->with('error', 'Order total must be at least KES 1.00');
        }

        $formattedPhone = $this->formatPhoneNumber($validated['mpesa_number']);

        // Generate unique order number
        do {
            $orderNumber = 'SIP' . now()->format('YmdHis') . rand(1000, 9999);
        } while (Order::where('order_number', $orderNumber)->exists());

        try {
            DB::beginTransaction();

            // Get or create customer
            $customer = $this->getOrCreateCustomer($formattedPhone, $validated['delivery_address'] ?? null);

            // Prepare addresses (required JSON fields)
            $billingAddress = [
                'phone' => $formattedPhone,
                'name' => trim($customer->first_name . ' ' . $customer->last_name),
                'email' => $customer->email ?? null,
            ];

            $shippingAddress = [
                'address' => $validated['delivery_address'] ?? 'Not provided',
                'phone' => $formattedPhone,
                'name' => trim($customer->first_name . ' ' . $customer->last_name),
                'email' => $customer->email ?? null,
            ];

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
                'billing_address' => $billingAddress,
                'shipping_address' => $shippingAddress,
            ]);

            // Create order items
            foreach ($items as $item) {
                $product = $item['product'];
                $sku = $product->sku;

                // Ensure SKU is not empty (required field)
                if (empty($sku)) {
                    $sku = 'SKU-' . $product->id . '-' . time();
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_sku' => $sku,
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

                // Show more detailed error message in debug mode
                $errorMsg = $response['message'] ?? 'Failed to initiate M-Pesa STK push.';
                if (config('app.debug')) {
                    $errorMsg .= ' Response Code: ' . ($response['response_code'] ?? 'N/A');
                }

                Log::error('Checkout STK push failed', [
                    'response' => $response,
                    'phone' => $formattedPhone,
                    'amount' => $totalAmount,
                ]);

                return back()->withInput()->with('error', $errorMsg);
            }

            // Store checkout request ID in order notes for callback tracking
            $order->update([
                'notes' => ($order->notes ? $order->notes . "\n" : '') .
                          "CheckoutRequestID: " . ($response['checkout_request_id'] ?? 'N/A'),
            ]);

            DB::commit();

            return redirect()->route('checkout')->with('success', $response['customer_message'] ?? 'STK push sent. Please complete payment on your phone.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            throw $e; // Re-throw validation exceptions
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            $errorMessage = $e->getMessage();
            $errorCode = $e->getCode();

            Log::error('Checkout database error', [
                'message' => $errorMessage,
                'code' => $errorCode,
                'sql' => $e->getSql() ?? 'N/A',
                'bindings' => $e->getBindings() ?? [],
                'trace' => $e->getTraceAsString(),
            ]);

            // Provide more specific error messages
            if (str_contains($errorMessage, 'billing_address') || str_contains($errorMessage, 'shipping_address')) {
                return back()->withInput()->with('error', 'Address information is invalid. Please check your delivery address.');
            } elseif (str_contains($errorMessage, 'foreign key constraint')) {
                return back()->withInput()->with('error', 'Data integrity error. Please refresh and try again.');
            } elseif (str_contains($errorMessage, 'Duplicate entry')) {
                return back()->withInput()->with('error', 'Order number already exists. Please try again.');
            }

            // For development, show the actual error; for production, show generic message
            $displayError = config('app.debug')
                ? 'Database error: ' . $errorMessage
                : 'Database error occurred. Please try again or contact support.';

            return back()->withInput()->with('error', $displayError);
        } catch (\RuntimeException $e) {
            DB::rollBack();
            Log::error('Checkout runtime error: ' . $e->getMessage());
            return back()->withInput()->with('error', $e->getMessage());
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Checkout STK push error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            return back()->withInput()->with('error', 'Unable to initiate payment: ' . $e->getMessage());
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
            // Create guest customer with unique email
            $email = 'guest_' . $phone . '_' . time() . '@sipandgo.local';

            // Ensure email is unique
            while (Customer::where('email', $email)->exists()) {
                $email = 'guest_' . $phone . '_' . time() . '_' . rand(1000, 9999) . '@sipandgo.local';
            }

            // Generate a random password for guest customers (they won't use it)
            $password = bcrypt(uniqid('guest_', true) . rand(1000, 9999));

            $customer = Customer::create([
                'first_name' => 'Guest',
                'last_name' => 'Customer',
                'email' => $email,
                'phone' => $phone,
                'password' => $password,
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

