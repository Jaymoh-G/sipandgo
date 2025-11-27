#!/bin/bash
# Script to clear Laravel caches on live server
# Run this on your live server via SSH

php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo "All caches cleared successfully!"

