<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sliders = [
            [
                'title' => ['en' => 'Discover the Red Sea', 'ar' => 'اكتشف البحر الأحمر'],
                'image_path' => 'https://images.unsplash.com/photo-1544526226-d4568090ea28?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
                'link' => '/tours',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => ['en' => 'Unforgettable Safari', 'ar' => 'سفاري لا تنسى'],
                'image_path' => 'https://images.unsplash.com/photo-1533090161767-e6ffed986c88?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
                'link' => '/tours?category=safari-adventures',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => ['en' => 'Crystal Clear Waters', 'ar' => 'مياه كريستالية'],
                'image_path' => 'https://images.unsplash.com/photo-1590523277543-a94d2e4eb00b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
                'link' => '/tours?category=island-trips',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($sliders as $slider) {
            Slider::create($slider);
        }
    }
}
