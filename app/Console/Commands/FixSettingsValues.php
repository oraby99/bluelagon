<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class FixSettingsValues extends Command
{
    protected $signature = 'settings:fix';
    protected $description = 'Fix settings values - convert JSON objects to JSON strings and show current state';

    public function handle()
    {
        $this->info('=== Current Settings in DB ===');
        $settings = DB::table('settings')->get();

        foreach ($settings as $setting) {
            $raw = $setting->value;
            $this->line("[{$setting->key}] raw DB value: {$raw}");

            $decoded = json_decode($raw, true);

            if (is_array($decoded)) {
                // Old KeyValue format like {"property":"actual_value"}
                // Extract the first value and store as JSON string
                $extracted = !empty($decoded) ? (string) reset($decoded) : '';
                $jsonString = json_encode($extracted); // Wrap as JSON string: "value"

                DB::table('settings')
                    ->where('id', $setting->id)
                    ->update(['value' => $jsonString]);

                $this->info("  → FIXED: {$raw}  →  {$jsonString}");
            } else {
                $this->line("  → OK (not a JSON object)");
            }

            // Clear cache for this setting
            Cache::forget("setting_{$setting->key}");
        }

        // Clear all cache
        $this->call('cache:clear');

        $this->newLine();
        $this->info('=== After Fix ===');
        $settings = DB::table('settings')->get();
        foreach ($settings as $setting) {
            $this->line("[{$setting->key}] = {$setting->value}");
        }

        $this->newLine();
        $this->info('Done! All settings fixed and cache cleared.');

        return Command::SUCCESS;
    }
}
