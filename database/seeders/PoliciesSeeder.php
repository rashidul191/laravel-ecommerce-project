<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PoliciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Define possible types for the policies
        $types = ['about', 'refund', 'terms', 'how to buy', 'contact', 'complain'];

        // Generate dynamic data for policies
        foreach ($types as $type) {
            DB::table('policies')->insert([
                'type' => $type,  // Assigning type from predefined array
                'des' => $faker->paragraphs(3, true),  // Random long description (3 paragraphs)
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
