<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'order_id',
        'tracking_number',
        'status',
        'carrier',
        'service_type',
        'shipping_cost',
        'shipping_address',
        'recipient_name',
        'recipient_phone',
        'delivery_notes',
        'special_instructions',
        'estimated_delivery_date',
        'shipped_at',
        'out_for_delivery_at',
        'delivered_at',
        'delivered_to',
        'delivery_failure_reason',
    ];

    protected $casts = [
        'shipping_cost' => 'decimal:2',
        'shipping_address' => 'array',
        'estimated_delivery_date' => 'datetime',
        'shipped_at' => 'datetime',
        'out_for_delivery_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    /**
     * Get the order that owns the delivery
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the store that owns the delivery
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Store::class);
    }

    /**
     * Scope a query to filter by status
     */
    public function scopeStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to filter by store
     */
    public function scopeForStore($query, $storeId)
    {
        return $query->where('store_id', $storeId);
    }
}

