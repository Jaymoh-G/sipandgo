<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\CartService;
use App\Services\MpesaService;
use Illuminate\Http\Request;
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
        $reference = 'SIP' . now()->format('YmdHis');

        try {
            $response = $this->mpesaService->stkPush(
                $formattedPhone,
                $totalAmount,
                $reference,
                $validated['delivery_address'] ?? null
            );

            if (!$response['success']) {
                return back()->withInput()->with('error', $response['message'] ?? 'Failed to initiate M-Pesa STK push.');
            }

            $this->cartService->clear();

            return redirect()->route('checkout')->with('success', $response['customer_message'] ?? 'STK push sent. Please complete payment on your phone.');
        } catch (\Throwable $e) {
            Log::error('Checkout STK push error: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Unable to initiate payment. Please try again.');
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

