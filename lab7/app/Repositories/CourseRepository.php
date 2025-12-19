<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository implements CourseRepositoryInterface
{
    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return Course::all();
    }

    public function find(int $id): Course
    {
        return Course::query()->findOrFail($id);
    }

    public function create(array $data): Course
    {
        return Course::query()->create($data);
    }

    public function update(Course $course, array $data): Course
    {
        $course->update($data);
        return $course;
    }

    public function delete(Course $course): bool
    {
        return $course->delete();
    }
}
