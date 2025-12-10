<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Organizer;
use Faker\Factory as Faker;

class OrganizerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $faker = Faker::create();

       foreach (range(1, 10) as $index) {
           Organizer::query()->create([
               'name' => $faker->name,
               'email' => $faker->email,
               'phone' => $faker->phoneNumber,
           ]);
       }
    }
}
