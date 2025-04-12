<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductSlidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get all the product IDs
        $productIds = DB::table('products')->pluck('id')->toArray();

        // Loop to insert fake product sliders
        foreach ($productIds as $productId) {
            DB::table('product_sliders')->insert([
                'title' => ucfirst($faker->words(3, true)), // Generate a title
                'short_des' => $faker->sentence(15), // Short description
                'price' => $faker->randomFloat(2, 10, 1000), // Random price
                'image' => 'images/sliders/' . $faker->imageUrl(800, 400, 'product'), // Generate image URL
                'product_id' => $productId, // Link the slider to a product
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
