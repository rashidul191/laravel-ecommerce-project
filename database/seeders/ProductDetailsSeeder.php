<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get all the product IDs
        $productIds = DB::table('products')->pluck('id')->toArray();

        // Loop to insert fake product details
        foreach ($productIds as $productId) {
            DB::table('product_details')->insert([
                'img1' => 'images/products/' . $faker->imageUrl(400, 300, 'technics'),
                'img2' => 'images/products/' . $faker->imageUrl(400, 300, 'fashion'),
                'img3' => 'images/products/' . $faker->imageUrl(400, 300, 'nature'),
                'img4' => 'images/products/' . $faker->imageUrl(400, 300, 'abstract'),
                'des' => $faker->paragraph(5),
                'color' => $faker->safeColorName(),
                'size' => $faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
                'product_id' => $productId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
