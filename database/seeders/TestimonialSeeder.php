<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 6; $i++) {
            Testimonial::create([
                'client_name' => fake()->name(),
                'content' => [
                    'en' => fake()->paragraph(),
                    'ar' => 'تجربة رائعة ومميزة، أنصح الجميع بتجربتها.'
                ],
                'rating' => fake()->numberBetween(4, 5),
                'is_active' => true,
            ]);
        }
    }
}
