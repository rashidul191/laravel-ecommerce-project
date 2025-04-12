<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SslcommerzAccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // List of common currencies for random selection
        $currencies = ['BDT', 'USD', 'EUR', 'GBP', 'INR', 'AUD'];

        // Generate dynamic data for SSLCommerz accounts
        for ($i = 0; $i < 5; $i++) { // Generate 5 dynamic SSLCommerz accounts
            DB::table('sslcommerz_accounts')->insert([
                'store_id' => $faker->lexify('store_???'),  // Random store ID like store_abc
                'store_passwd' => $faker->password(),  // Random store password
                'currency' => $faker->randomElement($currencies),  // Random currency
                'success_url' => $faker->url(),  // Random URL for success
                'fail_url' => $faker->url(),  // Random URL for failure
                'cancel_url' => $faker->url(),  // Random URL for cancellation
                'ipn_url' => $faker->url(),  // Random URL for IPN
                'init_url' => $faker->url(),  // Random URL for init
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
