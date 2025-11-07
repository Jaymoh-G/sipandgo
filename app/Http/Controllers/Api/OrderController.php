<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Order;
use App\Models\CartItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ApiResponseTrait;

    /**
     * Get user's orders
     */
    public function index(Request $request)
    {
        $orders = Order::where('customer_id', $request->user()->id)
            ->with(['items.product', 'payment'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return $this->success(
            OrderResource::collection($orders)->response()->getData(true),
            'Orders retrieved successfully'
        );
    }

    /**
     * Create a new order
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'shipping_address' => 'required|array',
            'shipping_address.name' => 'required|string',
            'shipping_address.street' => 'required|string',
            'shipping_address.city' => 'required|string',
            'shipping_address.state' => 'required|string',
            'shipping_address.zip' => 'required|string',
            'shipping_address.country' => 'required|string',
            'payment_method' => 'required|string|in:credit_card,debit_card,paypal',
        ]);

        $cartItems = CartItem::where('customer_id', $request->user()->id)
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return $this->error('Cart is empty', 400);
        }

        // Calculate totals
        $subtotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        $tax = $subtotal * 0.1; // 10% tax (adjust as needed)
        $shipping = 10.00; // Fixed shipping (adjust as needed)
        $total = $subtotal + $tax + $shipping;

        // Create order
        $order = Order::create([
            'customer_id' => $request->user()->id,
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'status' => 'pending',
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping' => $shipping,
            'total' => $total,
            'shipping_address' => $validated['shipping_address'],
        ]);

        // Create order items
        foreach ($cartItems as $cartItem) {
            $order->items()->create([
                'product_id' => $cartItem->product_id,
                'variant_id' => $cartItem->variant_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
                'total' => $cartItem->quantity * $cartItem->product->price,
            ]);
        }

        // Create payment record
        $order->payment()->create([
            'payment_method' => $validated['payment_method'],
            'amount' => $total,
            'status' => 'pending',
        ]);

        // Clear cart
        CartItem::where('customer_id', $request->user()->id)->delete();

        $order->load(['items.product', 'payment']);

        return $this->success(
            new OrderResource($order),
            'Order created successfully',
            201
        );
    }

    /**
     * Get specific order
     */
    public function show(Request $request, Order $order)
    {
        if ($order->customer_id !== $request->user()->id) {
            return $this->error('Unauthorized', 403);
        }

        $order->load(['items.product', 'payment']);

        return $this->success(
            new OrderResource($order),
            'Order retrieved successfully'
        );
    }

    /**
     * Cancel order
     */
    public function cancel(Request $request, Order $order)
    {
        if ($order->customer_id !== $request->user()->id) {
            return $this->error('Unauthorized', 403);
        }

        if (!in_array($order->status, ['pending', 'processing'])) {
            return $this->error('Order cannot be cancelled', 400);
        }

        $order->update(['status' => 'cancelled']);

        return $this->success(
            new OrderResource($order),
            'Order cancelled successfully'
        );
    }
}

