<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Course;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $levels = ['beginner', 'intermediate', 'advanced'];

        return [
            'title' => fake()->words(3, true),
            'summary' => fake()->sentence(10),
            'level' => fake()->randomElement($levels),
            'start_date' => fake()->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'seats' => fake()->numberBetween(10, 100),
        ];
    }
}
