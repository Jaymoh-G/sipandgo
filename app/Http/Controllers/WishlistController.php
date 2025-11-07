<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    protected const WISHLIST_KEY = 'wishlist';

    /**
     * Display wishlist page
     */
    public function index()
    {
        $items = $this->getItemsWithProducts();

        return view('storefront.wishlist.index', compact('items'));
    }

    /**
     * Add item to wishlist
     */
    public function add(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if (!$product->is_active) {
            return back()->with('error', 'Product is not available.');
        }

        // Check if product is in stock
        if (!$product->isInStock()) {
            return back()->with('error', 'This product is currently out of stock and cannot be added to wishlist.');
        }

        $wishlist = Session::get(self::WISHLIST_KEY, []);

        if (!isset($wishlist[$validated['product_id']])) {
            $wishlist[$validated['product_id']] = [
                'product_id' => $validated['product_id'],
                'unit_price' => $product->price,
            ];
            Session::put(self::WISHLIST_KEY, $wishlist);
            return back()->with('success', 'Product added to wishlist successfully!');
        }

        return back()->with('info', 'Product is already in your wishlist.');
    }

    /**
     * Remove item from wishlist
     */
    public function remove(int $productId)
    {
        $wishlist = Session::get(self::WISHLIST_KEY, []);

        if (isset($wishlist[$productId])) {
            unset($wishlist[$productId]);
            Session::put(self::WISHLIST_KEY, $wishlist);
            return back()->with('success', 'Product removed from wishlist successfully!');
        }

        return back()->with('error', 'Product not found in wishlist.');
    }

    /**
     * Clear wishlist
     */
    public function clear()
    {
        Session::forget(self::WISHLIST_KEY);
        return back()->with('success', 'Wishlist cleared successfully!');
    }

    /**
     * Get wishlist items with products
     */
    protected function getItemsWithProducts(): array
    {
        $wishlist = Session::get(self::WISHLIST_KEY, []);
        $items = [];

        foreach ($wishlist as $productId => $item) {
            $product = Product::where('id', $productId)
                ->where('is_active', true)
                ->with('category')
                ->first();

            if ($product) {
                $items[] = [
                    'product_id' => $productId,
                    'product' => $product,
                    'unit_price' => $item['unit_price'] ?? $product->price,
                ];
            }
        }

        return $items;
    }

    /**
     * Get wishlist count
     */
    public function getCount(): int
    {
        $wishlist = Session::get(self::WISHLIST_KEY, []);
        return count($wishlist);
    }
}

