<?php

use App\Http\Controllers\StoreController;
use App\Http\Controllers\StorefrontController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// Storefront routes
Route::get('/', [StorefrontController::class, 'home'])->name('home');
Route::get('/shop', [StorefrontController::class, 'shop'])->name('shop');
Route::get('/products/{slug}', [StorefrontController::class, 'show'])->name('products.show');

// Category routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

// Legacy product routes (redirect to shop)
Route::get('/products', [StorefrontController::class, 'shop'])->name('products.index');

// Cart routes
Route::prefix('cart')->group(function () {
    Route::get('/', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::put('/update/{productId}', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
    Route::delete('/remove/{productId}', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
    Route::post('/clear', [\App\Http\Controllers\CartController::class, 'clear'])->name('cart.clear');
    Route::get('/summary', [\App\Http\Controllers\CartController::class, 'summary'])->name('cart.summary');
});

// Checkout routes
Route::prefix('checkout')->group(function () {
    Route::get('/', [\App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout');
    Route::post('/', [\App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/success/{orderNumber}', [\App\Http\Controllers\CheckoutController::class, 'success'])->name('checkout.success');
});

// Wishlist routes
Route::prefix('wishlist')->group(function () {
    Route::get('/', [\App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/add', [\App\Http\Controllers\WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/remove/{productId}', [\App\Http\Controllers\WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::post('/clear', [\App\Http\Controllers\WishlistController::class, 'clear'])->name('wishlist.clear');
});

// Static pages
Route::get('/about', [StoreController::class, 'about'])->name('about');
Route::get('/contact', [StoreController::class, 'contact'])->name('contact');
