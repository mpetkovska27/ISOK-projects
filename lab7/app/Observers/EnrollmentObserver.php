<?php

namespace App\Observers;

use App\Models\Enrollment;
use Illuminate\Support\Facades\Log;

class EnrollmentObserver
{
    /**
     * Handle the Enrollment "created" event.
     */
    public function created(Enrollment $enrollment): void
    {
        $message = "New enrollment has been created: {$enrollment->student_name} for course ID {$enrollment->course_id}";
        Log::info($message);
    }

    /**
     * Handle the Enrollment "updated" event.
     */
    public function updated(Enrollment $enrollment): void
    {
        $message = "Enrollment has been updated: {$enrollment->student_name} (Status: {$enrollment->status})";
        Log::info($message);
    }

    /**
     * Handle the Enrollment "deleted" event.
     */
    public function deleted(Enrollment $enrollment): void
    {
        $message = "Enrollment has been deleted: {$enrollment->student_name}";
        Log::info($message);
    }

    /**
     * Handle the Enrollment "restored" event.
     */
    public function restored(Enrollment $enrollment): void
    {
        //
    }

    /**
     * Handle the Enrollment "force deleted" event.
     */
    public function forceDeleted(Enrollment $enrollment): void
    {
        //
    }
}
