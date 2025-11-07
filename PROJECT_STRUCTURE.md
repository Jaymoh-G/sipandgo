# Sip & Go - Laravel 11 E-commerce Project Structure

## Overview
This is a Laravel 11 e-commerce project for selling alcoholic drinks with:
- **Storefront**: Blade views under `resources/views/storefront`
- **Admin Panel**: FilamentPHP (already configured)
- **Multi-Tenant Support**: Database-ready with `tenant_id` columns
- **API**: RESTful API ready for React dashboard (Sanctum authentication)

## Project Structure

### Views Structure
```
resources/views/
├── storefront/          # Storefront views (MarketPro template)
│   ├── layout.blade.php
│   ├── index.blade.php
│   ├── about.blade.php
│   ├── contact.blade.php
│   ├── products/
│   │   ├── index.blade.php
│   │   └── show.blade.php
│   └── categories/
│       ├── index.blade.php
│       └── show.blade.php
└── store/              # Old views (can be removed after migration)
```

**Note**: Views in `resources/views/store` should be moved to `resources/views/storefront` and updated to extend `storefront.layout` instead of `store.layout`.

### API Structure
```
routes/
└── api.php              # API routes (v1 prefix)

app/Http/
├── Controllers/
│   └── Api/            # API controllers
│       ├── AuthController.php
│       ├── ProductController.php
│       ├── CategoryController.php
│       ├── CartController.php
│       └── OrderController.php
├── Resources/          # API resources
│   ├── ProductResource.php
│   ├── CategoryResource.php
│   ├── CartItemResource.php
│   ├── OrderResource.php
│   └── ...
└── Traits/
    └── ApiResponseTrait.php  # Standardized API responses
```

### Multi-Tenant Structure
```
app/
├── Models/
│   └── Tenant.php      # Tenant model
└── Traits/
    └── HasTenant.php   # Trait for tenant scoping

app/Http/Middleware/
└── TenantScope.php     # Middleware for tenant resolution

database/migrations/
├── 2025_01_15_000001_create_tenants_table.php
└── 2025_01_15_000002_add_tenant_id_to_tables.php
```

## Setup Instructions

### 1. Install Dependencies
```bash
composer install
npm install
```

### 2. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Database Setup
```bash
# Run migrations (includes multi-tenant tables)
php artisan migrate

# Seed database
php artisan db:seed
```

### 4. Sanctum Setup (Already Installed)
Sanctum is already installed. Ensure your `.env` has:
```
SANCTUM_STATEFUL_DOMAINS=localhost,127.0.0.1
SESSION_DRIVER=cookie
```

### 5. Move Storefront Views
The views are currently in `resources/views/store`. You need to:
1. Copy all files from `resources/views/store` to `resources/views/storefront`
2. Update all `@extends('store.layout')` to `@extends('storefront.layout')`
3. Update layout file reference in `resources/views/storefront/layout.blade.php`

### 6. Apply Multi-Tenant Trait
Add `HasTenant` trait to models that need tenant scoping:
```php
use App\Traits\HasTenant;

class Product extends Model
{
    use HasTenant;
    // ...
}
```

Models to update:
- Category
- Product
- ProductVariant
- Brand
- Supplier
- Inventory
- Customer
- Order
- OrderItem
- CartItem
- Payment

### 7. Register Middleware
Add `TenantScope` middleware to `bootstrap/app.php`:
```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->web(append: [
        \App\Http\Middleware\TenantScope::class,
    ]);
})
```

## API Endpoints

### Public Endpoints
- `POST /api/v1/register` - Register new user
- `POST /api/v1/login` - Login user
- `GET /api/v1/products` - List products
- `GET /api/v1/products/{id}` - Get product
- `GET /api/v1/categories` - List categories
- `GET /api/v1/categories/{id}` - Get category

### Protected Endpoints (Require `auth:sanctum`)
- `GET /api/v1/user` - Get authenticated user
- `POST /api/v1/logout` - Logout user
- `GET /api/v1/cart` - Get cart
- `POST /api/v1/cart/add` - Add to cart
- `PUT /api/v1/cart/update/{id}` - Update cart item
- `DELETE /api/v1/cart/remove/{id}` - Remove from cart
- `DELETE /api/v1/cart/clear` - Clear cart
- `GET /api/v1/orders` - List orders
- `POST /api/v1/orders` - Create order
- `GET /api/v1/orders/{id}` - Get order
- `POST /api/v1/orders/{id}/cancel` - Cancel order

### API Authentication
Include the token in the Authorization header:
```
Authorization: Bearer {token}
```

## Multi-Tenant Configuration

### Tenant Resolution
The `TenantScope` middleware resolves tenants from:
1. Subdomain (e.g., `tenant1.example.com`)
2. `X-Tenant-ID` header
3. Authenticated user's `tenant_id`
4. Default tenant (null for single-tenant mode)

### Using HasTenant Trait
Models with `HasTenant` trait automatically:
- Scope queries to current tenant
- Set `tenant_id` on creation
- Provide `forTenant()` scope method

## Admin Panel (Filament)
- URL: `/admin`
- Already configured with resources
- Access via Filament admin user

## Next Steps

1. **Move Views**: Copy store views to storefront directory
2. **Update Models**: Add `HasTenant` trait to relevant models
3. **Test API**: Test API endpoints with Postman/Insomnia
4. **Configure Tenant**: Set up tenant resolution logic
5. **React Dashboard**: Start building React frontend using API

## File Locations Summary

### Controllers
- Storefront: `app/Http/Controllers/` (StoreController, ProductController, CategoryController)
- API: `app/Http/Controllers/Api/`

### Resources
- API Resources: `app/Http/Resources/`

### Models
- Tenant: `app/Models/Tenant.php`
- Other models: `app/Models/`

### Migrations
- Tenant: `database/migrations/2025_01_15_000001_create_tenants_table.php`
- Tenant IDs: `database/migrations/2025_01_15_000002_add_tenant_id_to_tables.php`

### Middleware
- Tenant Scope: `app/Http/Middleware/TenantScope.php`

### Traits
- HasTenant: `app/Traits/HasTenant.php`
- ApiResponseTrait: `app/Http/Traits/ApiResponseTrait.php`

