<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'store_id',
        'order_id',
        'product_id',
        'product_variant_id',
        'product_name',
        'product_sku',
        'quantity',
        'unit_price',
        'total_price',
        'product_attributes',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'product_attributes' => 'array',
    ];

    /**
     * Get the store that owns the order item
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Store::class);
    }

    /**
     * Get the order that owns the order item
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product that owns the order item
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the product variant for the order item
     */
    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    /**
     * Scope a query to filter by store
     */
    public function scopeForStore($query, $storeId)
    {
        return $query->where('store_id', $storeId);
    }
}
