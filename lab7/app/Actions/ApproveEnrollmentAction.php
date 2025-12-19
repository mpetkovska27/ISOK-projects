<?php

namespace App\Actions;

use App\Models\Enrollment;

class ApproveEnrollmentAction
{
    public function execute(Enrollment $enrollment): Enrollment
    {
        abort_if($enrollment->status !== 'pending', 400, 'Enrollment must be pending to approve.');

        $enrollment->course->decrement('seats', $enrollment->seats_requested);
        $enrollment->update(['status' => 'approved']);

        return $enrollment->fresh();
    }
}
