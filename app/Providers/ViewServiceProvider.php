<?php

namespace App\Providers;

use App\Services\CartService;
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
        // Share cart data with all views
        View::composer('*', function ($view) {
            $cartService = app(CartService::class);
            $view->with([
                'cartCount' => $cartService->getCount(),
                'cartSubtotal' => $cartService->getSubtotal(),
            ]);
        });
    }
}

