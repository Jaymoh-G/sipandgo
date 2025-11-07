<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

        // Validate customer input
        $validated = $request->validate([
            // Customer Information
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:191',
            'phone' => 'nullable|string|max:255',
            'date_of_birth' => 'required|date|before:today|before:-18 years',

            // Billing Address
            'billing_address_line_1' => 'required|string|max:255',
            'billing_address_line_2' => 'nullable|string|max:255',
            'billing_city' => 'required|string|max:255',
            'billing_state' => 'required|string|max:255',
            'billing_postal_code' => 'required|string|max:255',
            'billing_country' => 'required|string|max:255',

            // Shipping Address
            'shipping_address_line_1' => 'required|string|max:255',
            'shipping_address_line_2' => 'nullable|string|max:255',
            'shipping_city' => 'required|string|max:255',
            'shipping_state' => 'required|string|max:255',
            'shipping_postal_code' => 'required|string|max:255',
            'shipping_country' => 'required|string|max:255',

            // Payment Information
            'payment_method' => 'required|string|in:credit_card,debit_card,paypal',

            // Terms and Conditions
            'terms_accepted' => 'required|accepted',
            'age_verified' => 'required|accepted',
        ]);

        try {
            DB::beginTransaction();

            // Find or create customer
            $customer = Customer::where('email', $validated['email'])->first();

            if (!$customer) {
                // Create new customer
                $customer = Customer::create([
                    'store_id' => null, // Set to default store or get from session
                    'first_name' => $validated['first_name'],
                    'last_name' => $validated['last_name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'] ?? null,
                    'date_of_birth' => $validated['date_of_birth'],
                    'age_verified' => true,
                    'age_verified_at' => now(),
                    'password' => Hash::make(Str::random(16)), // Random password for guest checkout
                    'address_line_1' => $validated['billing_address_line_1'],
                    'address_line_2' => $validated['billing_address_line_2'] ?? null,
                    'city' => $validated['billing_city'],
                    'state' => $validated['billing_state'],
                    'postal_code' => $validated['billing_postal_code'],
                    'country' => $validated['billing_country'],
                    'is_active' => true,
                    'email_verified' => false,
                ]);
            } else {
                // Update existing customer information
                $customer->update([
                    'first_name' => $validated['first_name'],
                    'last_name' => $validated['last_name'],
                    'phone' => $validated['phone'] ?? $customer->phone,
                    'address_line_1' => $validated['billing_address_line_1'],
                    'address_line_2' => $validated['billing_address_line_2'] ?? null,
                    'city' => $validated['billing_city'],
                    'state' => $validated['billing_state'],
                    'postal_code' => $validated['billing_postal_code'],
                    'country' => $validated['billing_country'],
                ]);
            }

            // Calculate order totals
            $subtotal = $this->cartService->getSubtotal();
            $taxRate = 0.10; // 10% tax rate
            $taxAmount = round($subtotal * $taxRate, 2);
            $shippingAmount = 10.00; // Fixed shipping
            $totalAmount = round($subtotal + $taxAmount + $shippingAmount, 2);

            // Generate order number
            $orderNumber = 'ORD-' . strtoupper(Str::random(8));

            // Create order
            $order = Order::create([
                'store_id' => null, // Set to default store or get from session
                'order_number' => $orderNumber,
                'customer_id' => $customer->id,
                'status' => 'pending',
                'subtotal' => $subtotal,
                'tax_amount' => $taxAmount,
                'shipping_amount' => $shippingAmount,
                'discount_amount' => 0,
                'total_amount' => $totalAmount,
                'currency' => 'USD',
                'payment_status' => 'pending',
                'payment_method' => $validated['payment_method'],
                'shipping_method' => 'standard',
                'billing_address' => [
                    'name' => $validated['first_name'] . ' ' . $validated['last_name'],
                    'address_line_1' => $validated['billing_address_line_1'],
                    'address_line_2' => $validated['billing_address_line_2'] ?? null,
                    'city' => $validated['billing_city'],
                    'state' => $validated['billing_state'],
                    'postal_code' => $validated['billing_postal_code'],
                    'country' => $validated['billing_country'],
                ],
                'shipping_address' => [
                    'name' => $validated['first_name'] . ' ' . $validated['last_name'],
                    'address_line_1' => $validated['shipping_address_line_1'],
                    'address_line_2' => $validated['shipping_address_line_2'] ?? null,
                    'city' => $validated['shipping_city'],
                    'state' => $validated['shipping_state'],
                    'postal_code' => $validated['shipping_postal_code'],
                    'country' => $validated['shipping_country'],
                ],
            ]);

            // Create order items
            foreach ($items as $item) {
                $product = $item['product'];

                OrderItem::create([
                    'store_id' => null, // Set to default store or get from session
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_variant_id' => null,
                    'product_name' => $product->name,
                    'product_sku' => $product->sku,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total_price' => $item['total'],
                    'product_attributes' => null,
                ]);
            }

            // Clear cart session
            $this->cartService->clear();

            DB::commit();

            // Send order confirmation email (using log driver)
            try {
                Mail::to($customer->email)->send(new OrderConfirmation($order));
            } catch (\Exception $e) {
                // Log email error but don't fail the order
                Log::error('Failed to send order confirmation email: ' . $e->getMessage());
            }

            return redirect()->route('checkout.success', $order->order_number)
                ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout error: ' . $e->getMessage());

            return back()->withInput()
                ->with('error', 'An error occurred while processing your order. Please try again.');
        }
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
}

