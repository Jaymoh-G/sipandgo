<?php

namespace App\Helpers;

use App\Models\Settings;

class SettingsHelper
{
    /**
     * Get a setting value
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get(string $key, $default = null)
    {
        return Settings::get($key, $default);
    }

    /**
     * Get all settings
     *
     * @return Settings
     */
    public static function all()
    {
        return Settings::getSettings();
    }

    /**
     * Get site name
     *
     * @return string
     */
    public static function siteName()
    {
        return static::get('site_name', 'Sip & Go');
    }

    /**
     * Get logo URL
     *
     * @return string|null
     */
    public static function logo()
    {
        $logo = static::get('logo');
        return $logo ? asset('storage/' . $logo) : null;
    }

    /**
     * Get favicon URL
     *
     * @return string|null
     */
    public static function favicon()
    {
        $favicon = static::get('favicon');
        return $favicon ? asset('storage/' . $favicon) : null;
    }

    /**
     * Get contact email
     *
     * @return string|null
     */
    public static function email()
    {
        return static::get('email');
    }

    /**
     * Get contact phone
     *
     * @return string|null
     */
    public static function phone()
    {
        return static::get('phone');
    }

    /**
     * Get full address
     *
     * @return string
     */
    public static function fullAddress()
    {
        $settings = static::all();
        $parts = array_filter([
            $settings->address,
            $settings->city,
            $settings->state,
            $settings->postal_code,
            $settings->country,
        ]);
        return implode(', ', $parts);
    }

    /**
     * Get currency symbol
     *
     * @return string
     */
    public static function currencySymbol()
    {
        return static::get('currency_symbol', 'Ksh');
    }

    /**
     * Format currency
     *
     * @param float $amount
     * @return string
     */
    public static function formatCurrency($amount)
    {
        return static::currencySymbol() . ' ' . number_format($amount, 2);
    }
}

