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
            // Handle legacy JSON-encoded values from old KeyValue form
            $decoded = json_decode($value, true);
            if (is_array($decoded)) {
                return !empty($decoded) ? (string) reset($decoded) : $default;
            }
            return $value ?: $default;
        });
    }
}
