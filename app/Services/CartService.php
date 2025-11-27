<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected const CART_KEY = 'cart';

    /**
     * Get all cart items
     */
    public function getItems(): array
    {
        return Session::get(self::CART_KEY, []);
    }

    /**
     * Get cart item by product ID
     */
    public function getItem(int $productId): ?array
    {
        $cart = $this->getItems();
        return $cart[$productId] ?? null;
    }

    /**
     * Add item to cart
     */
    public function add(int $productId, int $quantity = 1): bool
    {
        $product = Product::where('id', $productId)
            ->where('is_active', true)
            ->first();

        if (!$product) {
            return false;
        }

        // Check if product is in stock
        if (!$product->isInStock()) {
            return false;
        }

        // Check if requested quantity is available
        if ($product->track_inventory && $quantity > $product->current_stock) {
            return false;
        }

        $cart = $this->getItems();

        if (isset($cart[$productId])) {
            // Update quantity if item already exists
            $newQuantity = $cart[$productId]['quantity'] + $quantity;

            // Check if new total quantity exceeds stock
            if ($product->track_inventory && $newQuantity > $product->current_stock) {
                return false;
            }

            $cart[$productId]['quantity'] = $newQuantity;
        } else {
            // Add new item
            $cart[$productId] = [
                'product_id' => $productId,
                'quantity' => $quantity,
                'unit_price' => $product->price,
            ];
        }

        Session::put(self::CART_KEY, $cart);
        return true;
    }

    /**
     * Update item quantity
     */
    public function update(int $productId, int $quantity): bool
    {
        if ($quantity <= 0) {
            return $this->remove($productId);
        }

        $cart = $this->getItems();

        if (!isset($cart[$productId])) {
            return false;
        }

        $product = Product::where('id', $productId)
            ->where('is_active', true)
            ->first();

        if (!$product) {
            return false;
        }

        // Check if product is in stock
        if (!$product->isInStock()) {
            return false;
        }

        // Check if requested quantity exceeds available stock
        if ($product->track_inventory && $quantity > $product->current_stock) {
            return false;
        }

        $cart[$productId]['quantity'] = $quantity;
        Session::put(self::CART_KEY, $cart);
        return true;
    }

    /**
     * Remove item from cart
     */
    public function remove(int $productId): bool
    {
        $cart = $this->getItems();

        if (!isset($cart[$productId])) {
            return false;
        }

        unset($cart[$productId]);
        Session::put(self::CART_KEY, $cart);
        return true;
    }

    /**
     * Clear cart
     */
    public function clear(): void
    {
        Session::forget(self::CART_KEY);
    }

    /**
     * Get cart count (total items)
     */
    public function getCount(): int
    {
        $cart = $this->getItems();
        return array_sum(array_column($cart, 'quantity'));
    }

    /**
     * Get cart subtotal
     */
    public function getSubtotal(): float
    {
        $cart = $this->getItems();
        $subtotal = 0;

        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);
            if ($product) {
                $subtotal += $item['quantity'] * $item['unit_price'];
            }
        }

        return round($subtotal, 2);
    }

    /**
     * Get cart items with product details
     */
    public function getItemsWithProducts(): array
    {
        $cart = $this->getItems();
        $items = [];

        foreach ($cart as $productId => $item) {
            $product = Product::with('category')->find($productId);

            if ($product && $product->is_active) {
                $items[] = [
                    'product_id' => $productId,
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total' => $item['quantity'] * $item['unit_price'],
                ];
            } else {
                // Remove invalid items
                unset($cart[$productId]);
            }
        }

        // Update cart if items were removed
        if (count($cart) !== count($this->getItems())) {
            Session::put(self::CART_KEY, $cart);
        }

        return $items;
    }

    /**
     * Check if cart is empty
     */
    public function isEmpty(): bool
    {
        return empty($this->getItems());
    }
}

