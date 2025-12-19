<?php

namespace App\Repositories;

use App\Models\Enrollment;

class EnrollmentRepository implements EnrollmentRepositoryInterface
{
    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return Enrollment::all();
    }

    public function find(int $id): Enrollment
    {
        return Enrollment::query()->findOrFail($id);
    }

    public function create(array $data): Enrollment
    {
        return Enrollment::query()->create($data);
    }

    public function update(Enrollment $enrollment, array $data): Enrollment
    {
        $enrollment->update($data);
        return $enrollment;
    }
}
