<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizers = Organizer::all();
        foreach ($organizers as $organizer) {
            Event::factory()->count(2)->create(['organizer_id' => $organizer->id]);
        }
    }
}
