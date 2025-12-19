<?php

namespace App\Observers;

use App\Models\Course;
use Illuminate\Support\Facades\Log;

class CourseObserver
{
    /**
     * Handle the Course "created" event.
     */
    public function created(Course $course): void
    {
        $message = "New course has been created: {$course->title}";
        Log::info($message);
    }

    /**
     * Handle the Course "updated" event.
     */
    public function updated(Course $course): void
    {
        $message = "Course has been updated: {$course->title}";
        Log::info($message);
    }

    /**
     * Handle the Course "deleted" event.
     */
    public function deleted(Course $course): void
    {
        $message = "Course has been deleted: {$course->title}.";
        Log::info($message);
    }

    /**
     * Handle the Course "restored" event.
     */
    public function restored(Course $course): void
    {
        //
    }

    /**
     * Handle the Course "force deleted" event.
     */
    public function forceDeleted(Course $course): void
    {
        //
    }
}
