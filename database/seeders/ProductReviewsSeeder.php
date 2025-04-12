<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get all the IDs of customers and products
        $customerIds = DB::table('customer_profiles')->pluck('id')->toArray();
        $productIds = DB::table('products')->pluck('id')->toArray();

        // Loop to insert fake reviews
        for ($i = 0; $i < 30; $i++) {
            // Random rating between 1 and 5
            $rating = $faker->numberBetween(1, 5);
            
            // Create a random review
            DB::table('product_reviews')->insert([
                'description' => $faker->paragraph(),
                'rating' => $rating, // This could be a number or you can store it as string (based on your preference)
                'customer_id' => $faker->randomElement($customerIds),
                'product_id' => $faker->randomElement($productIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
