<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Enrollment;
use App\Models\Course;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enrollment>
 */
class EnrollmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = ['pending', 'approved', 'dropped'];

        return [
            'course_id' => Course::factory(),
            'student_name' => fake()->firstName . ' ' . fake()->lastName,
            'seats_requested' => fake()->numberBetween(1, 5),
            'status' => fake()->randomElement($statuses),
        ];
    }
}
