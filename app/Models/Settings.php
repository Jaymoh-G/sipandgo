<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [
        'site_name',
        'site_description',
        'logo',
        'favicon',
        'payment_methods_image',
        'email',
        'phone',
        'mobile',
        'address',
        'map_link',
        'city',
        'state',
        'postal_code',
        'country',
        'store_hours',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'linkedin_url',
        'youtube_url',
        'tiktok_url',
        'whatsapp_number',
        'currency',
        'currency_symbol',
        'timezone',
        'date_format',
        'time_format',
        'maintenance_mode',
        'maintenance_message',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'google_analytics_id',
        'facebook_pixel_id',
    ];

    protected $casts = [
        'maintenance_mode' => 'boolean',
    ];

    /**
     * Get the singleton settings instance
     */
    public static function getSettings(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }

    /**
     * Get a specific setting value
     */
    public static function get(string $key, $default = null)
    {
        $settings = static::getSettings();
        return $settings->$key ?? $default;
    }
}

