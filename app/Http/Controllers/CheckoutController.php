<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
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
            'phone' => ['required', 'string', 'regex:/^(?:\+?254|0)?7\d{8}$/'],
            'delivery_address' => ['nullable', 'string', 'max:500'],
        ]);

        $subtotal = $this->cartService->getSubtotal();
        $taxAmount = round($subtotal * 0.10, 2);
        $shippingAmount = 10.00;
        $totalAmount = round($subtotal + $taxAmount + $shippingAmount, 2);

        $formattedPhone = $this->formatPhoneNumber($validated['phone']);

        // Generate unique order number
        do {
            $orderNumber = 'SIP' . now()->format('YmdHis') . rand(1000, 9999);
        } while (Order::where('order_number', $orderNumber)->exists());

        try {
            DB::beginTransaction();

            // Get or create customer
            $customer = $this->getOrCreateCustomer($formattedPhone, $validated['email'], $validated['delivery_address'] ?? null);

            // Prepare addresses (required JSON fields)
            $billingAddress = [
                'phone' => $formattedPhone,
                'name' => trim($customer->first_name . ' ' . $customer->last_name),
                'email' => $customer->email ?? null,
            ];

            $shippingAddress = [
                'name' => trim($customer->first_name . ' ' . $customer->last_name),
                'address_line_1' => $validated['delivery_address'] ?? 'Not provided',
                'address_line_2' => null,
                'city' => 'Nairobi',
                'state' => 'Nairobi',
                'postal_code' => null,
                'country' => 'Kenya',
                'phone' => $formattedPhone,
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
                'payment_method' => 'pending',
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

            $this->cartService->clear();

            DB::commit();

            // Send order confirmation email (only if it's a real email address)
            try {
                if ($order->customer->email && !str_ends_with($order->customer->email, '@sipandgo.local')) {
                    Mail::to($order->customer->email)->send(new OrderConfirmation($order));
                }
            } catch (\Exception $e) {
                // Log email error but don't fail the order
                Log::error('Failed to send order confirmation email', [
                    'order_id' => $order->id,
                    'error' => $e->getMessage(),
                ]);
            }

            return redirect()->route('checkout.success', $orderNumber)->with('success', 'Order placed successfully. We will contact you to confirm.');
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
            Log::error('Checkout error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            return back()->withInput()->with('error', 'Unable to place order: ' . $e->getMessage());
        }
    }

    /**
     * Get or create customer for checkout
     */
    protected function getOrCreateCustomer(string $phone, string $email, ?string $address = null)
    {
        // If user is authenticated, use their customer record
        if (Auth::guard('customer')->check()) {
            return Auth::guard('customer')->user();
        }

        // For guest checkout, create or find a customer by phone or email
        $customer = Customer::where('phone', $phone)
            ->orWhere('email', $email)
            ->first();

        if (!$customer) {
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
        } else {
            // Update email if it was a fake guest email
            if (str_ends_with($customer->email, '@sipandgo.local')) {
                $customer->update(['email' => $email]);
            }
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

