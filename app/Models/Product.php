<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes;

    // Uncomment if Spatie Media Library is installed
    // use \Spatie\MediaLibrary\HasMedia;
    // use \Spatie\MediaLibrary\InteractsWithMedia;
    protected $fillable = [
        'store_id',
        'category_id',
        'name',
        'slug',
        'description',
        'short_description',
        'sku',
        'price',
        'compare_price',
        'cost_price',
        'brand',
        'alcohol_content',
        'volume',
        'origin_country',
        'min_age',
        'requires_age_verification',
        'is_taxable',
        'weight',
        'dimensions',
        'images',
        'attributes',
        'is_active',
        'is_featured',
        'track_inventory',
        'sort_order',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'compare_price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'weight' => 'decimal:2',
        'min_age' => 'integer',
        'requires_age_verification' => 'boolean',
        'is_taxable' => 'boolean',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'track_inventory' => 'boolean',
        'sort_order' => 'integer',
        'images' => 'array',
        'attributes' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });

        static::updating(function ($product) {
            if ($product->isDirty('name') && empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Store::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function inventory(): HasMany
    {
        return $this->hasMany(Inventory::class);
    }

    public function getCurrentStockAttribute(): int
    {
        $inventory = $this->inventory()->first();
        return $inventory ? $inventory->quantity_available : 0;
    }

    public function getIsLowStockAttribute(): bool
    {
        if (!$this->track_inventory) {
            return false;
        }

        $inventory = $this->inventory()->first();
        if (!$inventory) {
            return false;
        }

        return $inventory->quantity_available <= $inventory->low_stock_threshold;
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getFormattedPriceAttribute(): string
    {
        return '$' . number_format($this->price, 2);
    }

    public function getIsOnSaleAttribute(): bool
    {
        return $this->compare_price && $this->compare_price > $this->price;
    }

    public function getDiscountPercentageAttribute(): ?int
    {
        if (!$this->is_on_sale) {
            return null;
        }

        return round((($this->compare_price - $this->price) / $this->compare_price) * 100);
    }

    public function getPrimaryImageUrlAttribute(): ?string
    {
        // Check if Spatie Media Library is available and has media
        if (method_exists($this, 'getFirstMediaUrl')) {
            $mediaUrl = $this->getFirstMediaUrl('product-images');
            if ($mediaUrl) {
                return $mediaUrl;
            }
        }

        // Fallback to JSON images field
        if (!$this->images || empty($this->images)) {
            return null;
        }

        $firstImage = is_array($this->images) ? $this->images[0] : $this->images;

        // If it's already a full URL (from seeder), return as is
        if (filter_var($firstImage, FILTER_VALIDATE_URL)) {
            return $firstImage;
        }

        // If it's a relative path, convert to full URL
        return asset('storage/' . ltrim($firstImage, '/'));
    }

    /**
     * Get product image with fallback
     */
    public function getImageUrl(?string $size = null): ?string
    {
        // Check if Spatie Media Library is available
        if (method_exists($this, 'getFirstMediaUrl')) {
            $mediaUrl = $this->getFirstMediaUrl('product-images', $size);
            if ($mediaUrl) {
                return $mediaUrl;
            }
        }

        return $this->primary_image_url;
    }
}
