<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasTenant
{
    /**
     * Boot the trait
     */
    public static function bootHasTenant()
    {
        // Automatically scope queries to current tenant
        static::addGlobalScope('tenant', function (Builder $builder) {
            $tenantId = app('tenant_id');

            if ($tenantId) {
                $builder->where('tenant_id', $tenantId);
            }
        });

        // Automatically set tenant_id when creating
        static::creating(function ($model) {
            if (empty($model->tenant_id)) {
                $tenantId = app('tenant_id');
                if ($tenantId) {
                    $model->tenant_id = $tenantId;
                }
            }
        });
    }

    /**
     * Get the tenant that owns the model
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Tenant::class);
    }

    /**
     * Scope a query to a specific tenant
     */
    public function scopeForTenant(Builder $query, $tenantId): Builder
    {
        return $query->where('tenant_id', $tenantId);
    }
}

