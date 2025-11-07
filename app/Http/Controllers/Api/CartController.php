<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartItemResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use ApiResponseTrait;

    /**
     * Get user's cart
     */
    public function index(Request $request)
    {
        $cartItems = CartItem::where('customer_id', $request->user()->id)
            ->with(['product', 'product.category'])
            ->get();

        return $this->success(
            CartItemResource::collection($cartItems),
            'Cart retrieved successfully'
        );
    }

    /**
     * Add item to cart
     */
    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'variant_id' => 'nullable|exists:product_variants,id',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if (!$product->is_active) {
            return $this->error('Product is not available', 400);
        }

        $cartItem = CartItem::updateOrCreate(
            [
                'customer_id' => $request->user()->id,
                'product_id' => $validated['product_id'],
                'variant_id' => $validated['variant_id'] ?? null,
            ],
            [
                'quantity' => $validated['quantity'],
            ]
        );

        $cartItem->load(['product', 'product.category']);

        return $this->success(
            new CartItemResource($cartItem),
            'Item added to cart successfully',
            201
        );
    }

    /**
     * Update cart item
     */
    public function update(Request $request, CartItem $cartItem)
    {
        if ($cartItem->customer_id !== $request->user()->id) {
            return $this->error('Unauthorized', 403);
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem->update(['quantity' => $validated['quantity']]);
        $cartItem->load(['product', 'product.category']);

        return $this->success(
            new CartItemResource($cartItem),
            'Cart item updated successfully'
        );
    }

    /**
     * Remove item from cart
     */
    public function remove(Request $request, CartItem $cartItem)
    {
        if ($cartItem->customer_id !== $request->user()->id) {
            return $this->error('Unauthorized', 403);
        }

        $cartItem->delete();

        return $this->success(null, 'Item removed from cart successfully');
    }

    /**
     * Clear cart
     */
    public function clear(Request $request)
    {
        CartItem::where('customer_id', $request->user()->id)->delete();

        return $this->success(null, 'Cart cleared successfully');
    }
}

