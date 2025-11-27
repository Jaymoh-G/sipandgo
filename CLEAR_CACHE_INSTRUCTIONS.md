# Clear Route Cache on Live Server

The FAQ route error is happening because the route cache on the live server is stale.

## Solution: Run these commands on your live server via SSH

```bash
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

## Alternative: If you have route caching enabled

If your live server uses route caching (for performance), you'll need to rebuild it:

```bash
php artisan route:clear
php artisan route:cache
```

## Important Notes:

1. Make sure the latest code with the FAQ route is deployed to the live server
2. The route is defined in `routes/web.php` line 49: `Route::get('/faq', [StoreController::class, 'faq'])->name('faq');`
3. The controller method exists in `app/Http/Controllers/StoreController.php` line 39-42
4. After clearing caches, the route should work

## If the error persists:

1. Check that `resources/views/storefront/faq.blade.php` exists on the live server
2. Verify the `StoreController@faq` method exists
3. Check Laravel logs: `storage/logs/laravel.log` for more details

