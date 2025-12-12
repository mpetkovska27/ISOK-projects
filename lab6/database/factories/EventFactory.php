<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;
use App\Models\Organizer;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $eventTypes = [
            'Conference',
            'Seminar',
            'Workshop',
            'Sporting Event'
        ];

        return [
            'name' => fake()->words(3, true),
            'description' => fake()->sentence(8),
            'type' => fake()->randomElement($eventTypes),
            'date' => fake()->date(),
            'organizer_id' => Organizer::factory(),
        ];
    }
}
