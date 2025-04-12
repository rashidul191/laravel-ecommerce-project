<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $categoryIds = DB::table('categories')->pluck('id')->toArray();
        $brandIds = DB::table('brands')->pluck('id')->toArray();

        $remarks = ['popular', 'new', 'top', 'special', 'trending', 'regular'];

        for ($i = 0; $i < 20; $i++) {
            $price = $faker->randomFloat(2, 10, 1000); // original price
            $hasDiscount = $faker->boolean(50); // 50% chance for discount
            $discountPrice = $hasDiscount ? round($price * $faker->randomFloat(1, 0.5, 0.9), 2) : 0;

            DB::table('products')->insert([
                'title' => ucfirst($faker->words(3, true)),
                'short_des' => $faker->sentence(10),
                'price' => number_format($price, 2),
                'discount' => $hasDiscount,
                'discount_price' => number_format($discountPrice, 2),
                'image' => 'images/products/' . $faker->uuid . '.jpg',
                'stock' => $faker->boolean(80), // 80% chance in stock
                'star' => $faker->randomFloat(1, 1, 5),
                'remark' => $faker->randomElement($remarks),
                'category_id' => $faker->randomElement($categoryIds),
                'brand_id' => $faker->randomElement($brandIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
