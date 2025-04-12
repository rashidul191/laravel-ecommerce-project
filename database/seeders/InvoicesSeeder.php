<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class InvoicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get all user IDs (for associating invoices with users)
        $userIds = DB::table('users')->pluck('id')->toArray();

        // Define sample delivery statuses and payment statuses
        $deliveryStatuses = ['Pending', 'Processing', 'Completed'];
        $paymentStatuses = ['Pending', 'Paid', 'Failed'];

        // Generate dynamic data for invoices
        for ($i = 0; $i < 10; $i++) { // Generating 10 dynamic invoices
            $userId = $faker->randomElement($userIds);  // Randomly select a user ID

            DB::table('invoices')->insert([
                'total' => $faker->randomFloat(2, 100, 1000),  // Random total between 100 and 1000
                'vat' => $faker->randomFloat(2, 10, 50),  // Random VAT between 10 and 50
                'payable' => $faker->randomFloat(2, 110, 1050),  // Payable = total + VAT (example)
                'cus_details' => $faker->address(),  // Random customer address
                'ship_details' => $faker->address(),  // Random shipping address
                'tran_id' => $faker->uuid(),  // Random transaction ID
                'val_id' => $faker->randomElement([0, 1]),  // Random validation ID (default 0 or 1)
                'delivery_status' => $faker->randomElement($deliveryStatuses),  // Random delivery status
                'payment_status' => $faker->randomElement($paymentStatuses),  // Random payment status
                'user_id' => $userId,  // Assigning the invoice to a random user
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
