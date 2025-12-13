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
                'image_path' => 'https://media.gettyimages.com/id/2181547667/photo/a-picture-shows-a-partial-view-of-the-egyptian-red-sea-resort-of-el-gouna-on-november-1-2024.jpg?s=612x612&w=gi&k=20&c=09x-1RviqS4nTwYMxOqIkxvqQgHutQ5BP1x50o85WLA=',
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
