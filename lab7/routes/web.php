<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrganizerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('courses.index');
});

Route::resource('organizers', OrganizerController::class);
Route::resource('events', EventController::class);
Route::resource('courses', CourseController::class);

Route::get('enrollments/create', [EnrollmentController::class, 'create'])->name('enrollments.create');
Route::post('enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');
Route::put('enrollments/{enrollment}/approve', [EnrollmentController::class, 'approve'])->name('enrollments.approve');
Route::put('enrollments/{enrollment}/drop', [EnrollmentController::class, 'drop'])->name('enrollments.drop');
