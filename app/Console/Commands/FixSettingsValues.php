<?php

namespace App\Console\Commands;

use App\Models\Setting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class FixSettingsValues extends Command
{
    protected $signature = 'settings:fix';
    protected $description = 'Fix settings values that were stored as JSON from the old KeyValue form';

    public function handle()
    {
        $settings = Setting::all();
        $fixed = 0;

        foreach ($settings as $setting) {
            $original = $setting->value;

            // Try to decode as JSON
            $decoded = json_decode($original, true);

            if (is_array($decoded)) {
                // Extract the first value from the JSON object
                $newValue = !empty($decoded) ? (string) reset($decoded) : '';
                $setting->value = $newValue;
                $setting->save();

                $this->info("Fixed [{$setting->key}]: \"{$original}\" → \"{$newValue}\"");
                $fixed++;
            } else {
                $this->line("OK [{$setting->key}]: \"{$original}\" (already a string)");
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
