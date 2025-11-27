<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display cart page
     */
    public function index()
    {
        $items = $this->cartService->getItemsWithProducts();
        $subtotal = $this->cartService->getSubtotal();
        $count = $this->cartService->getCount();

        return view('storefront.cart.index', compact('items', 'subtotal', 'count'));
    }

    /**
     * Add item to cart
     */
    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1|max:99',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if (!$product->is_active) {
            return back()->with('error', 'Product is not available.');
        }

        // Check if product is in stock
        if (!$product->isInStock()) {
            return back()->with('error', 'This product is currently out of stock.');
        }

        $quantity = $validated['quantity'] ?? 1;

        // Check if requested quantity is available
        if ($product->track_inventory && $quantity > ($product->quantity ?? 0)) {
            return back()->with('error', 'Requested quantity exceeds available stock. Only ' . ($product->quantity ?? 0) . ' items available.');
        }

        $success = $this->cartService->add($validated['product_id'], $quantity);

        if ($success) {
            return back()->with('success', 'Product added to cart successfully!');
        }

        return back()->with('error', 'Failed to add product to cart.');
    }

    /**
     * Update item quantity
     */
    public function update(Request $request, int $productId)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        $product = Product::find($productId);

        if ($product && $product->track_inventory && $validated['quantity'] > ($product->quantity ?? 0)) {
            return back()->with('error', 'Requested quantity exceeds available stock. Only ' . ($product->quantity ?? 0) . ' items available.');
        }

        $success = $this->cartService->update($productId, $validated['quantity']);

        if ($success) {
            return back()->with('success', 'Cart updated successfully!');
        }

        return back()->with('error', 'Failed to update cart item. Product may be out of stock.');
    }

    /**
     * Remove item from cart
     */
    public function remove(int $productId)
    {
        $success = $this->cartService->remove($productId);

        if ($success) {
            return back()->with('success', 'Item removed from cart successfully!');
        }

        return back()->with('error', 'Failed to remove item from cart.');
    }

    /**
     * Clear cart
     */
    public function clear()
    {
        $this->cartService->clear();
        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully!');
    }

    /**
     * Get cart summary (for AJAX requests)
     */
    public function summary()
    {
        $count = $this->cartService->getCount();
        $subtotal = $this->cartService->getSubtotal();

        return response()->json([
            'count' => $count,
            'subtotal' => number_format($subtotal, 2),
            'formatted_subtotal' => '$' . number_format($subtotal, 2),
        ]);
    }
}

