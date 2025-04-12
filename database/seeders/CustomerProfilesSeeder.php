<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CustomerProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get all user IDs to assign one profile per user
        $userIds = User::pluck('id');

        foreach ($userIds as $userId) {
            DB::table('customer_profiles')->insert([
                'cus_name' => $faker->name(),
                'cus_address' => $faker->address(),
                'cus_city' => $faker->city(),
                'cus_state' => $faker->state(),
                'cus_postcode' => $faker->postcode(),
                'cus_country' => $faker->country(),
                'cus_phone' => $faker->phoneNumber(),
                'cus_fax' => $faker->phoneNumber(),

                'ship_name' => $faker->name(),
                'ship_address' => $faker->address(),
                'ship_city' => $faker->city(),
                'ship_state' => $faker->state(),
                'ship_postcode' => $faker->postcode(),
                'ship_country' => $faker->country(),
                'ship_phone' => $faker->phoneNumber(),

                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
