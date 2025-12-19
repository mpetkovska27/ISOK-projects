<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Observers\CourseObserver;
use App\Observers\EnrollmentObserver;
use App\Repositories\CourseRepository;
use App\Repositories\CourseRepositoryInterface;
use App\Repositories\EnrollmentRepository;
use App\Repositories\EnrollmentRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CourseRepositoryInterface::class, CourseRepository::class);
        $this->app->singleton(EnrollmentRepositoryInterface::class, EnrollmentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Course::observe(CourseObserver::class);
        Enrollment::observe(EnrollmentObserver::class);
    }
}
