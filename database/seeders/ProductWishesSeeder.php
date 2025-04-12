<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductWishesSeeder extends Seeder
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

        // Loop to insert fake product wishes
        foreach ($userIds as $userId) {
            $wishCount = $faker->numberBetween(1, 5); // Each user can have 1 to 5 wished products

            // Randomly select products for each user
            $wishedProducts = $faker->randomElements($productIds, $wishCount);

            foreach ($wishedProducts as $productId) {
                DB::table('product_wishes')->insert([
                    'product_id' => $productId,
                    'user_id' => $userId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
