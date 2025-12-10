<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Organizer;
use Faker\Factory as Faker;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizers = Organizer::all();
        $faker = Faker::create();
        foreach ($organizers as $organizer) {
            Event::query()->create([
                'organizer_id' => $organizer->id,
                'name' => $faker->name,
                'description' => $faker->text,
                'type' => $faker->text,
                'date' => $faker->date,
            ]);
        }
    }
}
