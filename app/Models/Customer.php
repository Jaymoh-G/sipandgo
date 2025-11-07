<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'store_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'age_verified',
        'age_verified_at',
        'password',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'postal_code',
        'country',
        'is_active',
        'email_verified',
        'email_verified_at',
        'preferred_language',
        'preferences',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'age_verified' => 'boolean',
        'age_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'email_verified' => 'boolean',
        'email_verified_at' => 'datetime',
        'preferences' => 'array',
    ];

    /**
     * Get the store that owns the customer
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Store::class);
    }

    /**
     * Get the orders for the customer
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the customer's full name
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Scope a query to filter by store
     */
    public function scopeForStore($query, $storeId)
    {
        return $query->where('store_id', $storeId);
    }

    /**
     * Scope a query to filter active customers
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
