<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventory extends Model
{
    protected $table = 'inventory';

    protected $fillable = [
        'product_id',
        'product_variant_id',
        'supplier_id',
        'quantity_on_hand',
        'quantity_reserved',
        'quantity_available',
        'low_stock_threshold',
        'reorder_point',
        'reorder_quantity',
        'cost_per_unit',
        'location',
        'bin_location',
    ];

    protected $casts = [
        'quantity_on_hand' => 'integer',
        'quantity_reserved' => 'integer',
        'quantity_available' => 'integer',
        'low_stock_threshold' => 'integer',
        'reorder_point' => 'integer',
        'reorder_quantity' => 'integer',
        'cost_per_unit' => 'decimal:2',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }
}
