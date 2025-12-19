<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = Course::all();
        foreach ($courses as $course) {

            $enrollmentCount = rand(1, 2);
            Enrollment::factory()->count($enrollmentCount)->create([
                'course_id' => $course->id,
            ]);
        }
    }
}
