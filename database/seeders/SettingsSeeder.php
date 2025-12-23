<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $footerSettings = [
            [
                'key' => 'footer_phone',
                'value' => '+20 100 000 0000',
                'group' => 'footer',
            ],
            [
                'key' => 'footer_address',
                'value' => 'Hurghada, Red Sea, Egypt',
                'group' => 'footer',
            ],
            [
                'key' => 'footer_email',
                'value' => 'info@bluelagon.com',
                'group' => 'footer',
            ],
            [
                'key' => 'footer_whatsapp',
                'value' => 'https://wa.me/201000000000',
                'group' => 'footer',
            ],
            [
                'key' => 'footer_facebook',
                'value' => '#',
                'group' => 'footer',
            ],
            [
                'key' => 'footer_instagram',
                'value' => '#',
                'group' => 'footer',
            ],
        ];

        foreach ($footerSettings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
