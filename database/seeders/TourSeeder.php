<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Tour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            for ($i = 1; $i <= 3; $i++) {
                $tour = Tour::create([
                    'category_id' => $category->id,
                    'name' => [
                        'en' => "{$category->name} Tour {$i}",
                        'ar' => "جولة {$category->getTranslation('name', 'ar')} {$i}"
                    ],
                    'slug' => "{$category->slug}-tour-{$i}",
                    'description' => [
                        'en' => fake()->paragraph(3),
                        'ar' => 'هذا وصف تجريبي للجولة يحتوي على تفاصيل ومعلومات وهمية لغرض العرض.',
                    ],
                    'price' => fake()->numberBetween(30, 150),
                    'location' => 'Hurghada, Red Sea',
                    'duration' => fake()->randomElement(['4 Hours', '6 Hours', '8 Hours', 'Full Day']),
                    'includes' => ['en' => ['Transfer', 'Lunch', 'Drinks'], 'ar' => ['توصيل', 'غداء', 'مشروبات']],
                    'excludes' => ['en' => ['Personal Expenses', 'Tips'], 'ar' => ['مصاريف شخصية', 'إكراميات']],
                    'schedule' => [
                        '08:00 AM' => 'Pickup from Hotel',
                        '09:00 AM' => 'Arrival at Marina',
                        '10:00 AM' => 'Start Activity',
                        '01:00 PM' => 'Lunch Break',
                        '04:00 PM' => 'Return to Hotel',
                    ],
                    'is_active' => true,
                ]);

                // Add a placeholder image from a public URL if possible, or skip media for now if no local files
                // For now, we rely on the view handling missing media gracefully or using a placeholder URL
            }
        }
    }
}
