<?php

use Illuminate\Support\Facades\Cache;

if (!function_exists('setting')) {
    /**
     * Get a setting value from the database with caching.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting($key, $default = null)
    {
        return Cache::remember("setting_{$key}", 3600, function () use ($key, $default) {
            $setting = \App\Models\Setting::where('key', $key)->first();
            if (!$setting) {
                return $default;
            }
            $value = $setting->value;
            // If the cast returned an array, try to get a usable string
            if (is_array($value)) {
                return !empty($value) ? (string) reset($value) : $default;
            }
            return $value;
        });
    }
}
