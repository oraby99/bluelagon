<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            BlogPost::create([
                'title' => [
                    'en' => fake()->sentence(),
                    'ar' => 'عنوان مقال تجريبي ' . $i
                ],
                'slug' => 'blog-post-' . $i,
                'content' => [
                    'en' => fake()->paragraphs(3, true),
                    'ar' => 'هذا محتوى مقال تجريبي يحتوي على معلومات وهمية لغرض العرض والتجربة.'
                ],
                'published_at' => fake()->dateTimeBetween('-1 month', 'now'),
                'is_active' => true,
            ]);
        }
    }
}
