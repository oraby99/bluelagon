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
            // Array cast returns string for JSON strings, array for JSON objects
            if (is_string($value)) {
                return $value ?: $default;
            }
            // Old KeyValue format stored as JSON object {"key":"val"}
            if (is_array($value)) {
                return !empty($value) ? (string) reset($value) : $default;
            }
            return $default;
        });
    }
}
