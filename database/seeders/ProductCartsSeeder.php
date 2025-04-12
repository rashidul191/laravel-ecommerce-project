<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductCartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get all the product and user IDs
        $productIds = DB::table('products')->pluck('id')->toArray();
        $userIds = DB::table('users')->pluck('id')->toArray();

        // Loop to insert fake product carts
        foreach ($userIds as $userId) {
            $cartCount = $faker->numberBetween(1, 5); // Each user can have 1 to 5 items in their cart

            // Randomly select products for each user
            $cartProducts = $faker->randomElements($productIds, $cartCount);

            foreach ($cartProducts as $productId) {
                DB::table('product_carts')->insert([
                    'user_id' => $userId, // User ID (random user from the list)
                    'product_id' => $productId, // Product ID (random product from the list)
                    'color' => $faker->safeColorName(), // Random color name
                    'size' => $faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']), // Random size
                    'qty' => $faker->numberBetween(1, 3), // Random quantity (1 to 3)
                    'price' => $faker->randomFloat(2, 10, 1000), // Random price between 10 and 1000
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
