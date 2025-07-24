<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Testing\Fakes\Fake;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 10; $i++) {
            \App\Models\Category::create([
                'category_name' => ucfirst($faker->unique()->words(2, true)),
                'slug' => \Illuminate\Support\Str::slug($faker->unique()->words(2, true)),
                'description' => $faker->sentence(),
            ]);
        }
        // Alternatively, you can use the factory to create categories
        \App\Models\Category::factory(10)->create();
        // This will create 10 categories with random data
        // using the CategoryFactory defined in database/factories/CategoryFactory.php
    }
}
