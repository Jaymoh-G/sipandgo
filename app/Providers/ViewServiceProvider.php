<?php

namespace App\Providers;

use App\Models\Category;
use App\Services\CartService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share cart data, wishlist count, and categories with all views
        View::composer('*', function ($view) {
            $cartService = app(CartService::class);

            // Get wishlist count and items from session
            $wishlist = Session::get('wishlist', []);
            $wishlistCount = count($wishlist);
            $wishlistItems = array_keys($wishlist); // Get product IDs in wishlist

            // Get active categories for dropdowns
            $headerCategories = Category::where('is_active', true)
                ->whereNull('parent_id')
                ->orderBy('sort_order')
                ->orderBy('name')
                ->limit(8)
                ->get();

            $view->with([
                'cartCount' => $cartService->getCount(),
                'cartSubtotal' => $cartService->getSubtotal(),
                'wishlistCount' => $wishlistCount,
                'wishlistItems' => $wishlistItems, // Array of product IDs in wishlist
                'headerCategories' => $headerCategories,
            ]);
        });
    }
}

