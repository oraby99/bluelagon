<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => ['en' => 'Island Trips', 'ar' => 'رحلات الجزر'],
                'slug' => 'island-trips',
                'type' => 'island',
                'is_active' => true,
            ],
            [
                'name' => ['en' => 'Safari Adventures', 'ar' => 'مغامرات السفاري'],
                'slug' => 'safari-adventures',
                'type' => 'safari',
                'is_active' => true,
            ],
            [
                'name' => ['en' => 'Sea Activities', 'ar' => 'أنشطة بحرية'],
                'slug' => 'sea-activities',
                'type' => 'activity',
                'is_active' => true,
            ],
            [
                'name' => ['en' => 'City Tours', 'ar' => 'جولات المدينة'],
                'slug' => 'city-tours',
                'type' => 'city',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
