<?php

namespace App\Console\Commands;

use App\Models\Setting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class FixSettingsValues extends Command
{
    protected $signature = 'settings:fix';
    protected $description = 'Fix settings values that were stored as JSON objects from the old KeyValue form';

    public function handle()
    {
        $settings = Setting::all();
        $fixed = 0;

        foreach ($settings as $setting) {
            $value = $setting->value; // decoded by array cast

            if (is_array($value)) {
                // Old KeyValue format: {"property": "actual_value"}
                $newValue = !empty($value) ? (string) reset($value) : '';
                // Setting via model attribute triggers the cast to json_encode properly
                $setting->value = $newValue;
                $setting->save();

                $this->info("Fixed [{$setting->key}]: " . json_encode($value) . " → \"{$newValue}\"");
                $fixed++;
            } else {
                $this->line("OK [{$setting->key}]: \"{$value}\" (already a plain value)");
            }

            // Clear cache for this setting
            Cache::forget("setting_{$setting->key}");
        }

        // Clear all application cache
        $this->call('cache:clear');

        $this->newLine();
        $this->info("Done! Fixed {$fixed} settings. Cache cleared.");

        return Command::SUCCESS;
    }
}
