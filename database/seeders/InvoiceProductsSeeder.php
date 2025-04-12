<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class InvoiceProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get all invoice IDs, product IDs, and user IDs (for associating with products and invoices)
        $invoiceIds = DB::table('invoices')->pluck('id')->toArray();
        $productIds = DB::table('products')->pluck('id')->toArray();
        $userIds = DB::table('users')->pluck('id')->toArray();

        // Generate dynamic data for invoice_products
        for ($i = 0; $i < 20; $i++) { // Generate 20 dynamic invoice-product associations
            $invoiceId = $faker->randomElement($invoiceIds);  // Randomly select an invoice ID
            $productId = $faker->randomElement($productIds);  // Randomly select a product ID
            $userId = $faker->randomElement($userIds);  // Randomly select a user ID

            DB::table('invoice_products')->insert([
                'invoice_id' => $invoiceId,
                'product_id' => $productId,
                'user_id' => $userId,
                'qty' => $faker->randomNumber(2),  // Random quantity (e.g., 1, 5, 12)
                'sale_price' => $faker->randomFloat(2, 50, 500),  // Random sale price between 50 and 500
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
