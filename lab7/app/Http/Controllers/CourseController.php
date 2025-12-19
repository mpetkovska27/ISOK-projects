<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Repositories\CourseRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    protected CourseRepositoryInterface $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function index(Request $request): View
    {
        $search = $request->get('search', '');

        $courses = Course::query()
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', '%' . $search . '%');
            })
            ->select('id', 'title', 'level', 'start_date', 'seats')
            ->latest()
            ->paginate(10);

        return view('courses.index', compact('courses', 'search'));
    }

    public function create(): View
    {
        return view('courses.create');
    }

    public function store(StoreCourseRequest $request): RedirectResponse
    {
        $this->courseRepository->create($request->validated());

        return redirect()->route('courses.index')
            ->with('success', 'Course created successfully.');
    }

    public function show(Course $course): View
    {
        $course->load('enrollments');

        return view('courses.show', compact('course'));
    }

    public function edit(Course $course): View
    {
        return view('courses.edit', compact('course'));
    }

    public function update(UpdateCourseRequest $request, Course $course): RedirectResponse
    {
        $this->courseRepository->update($course, $request->validated());

        return redirect()->route('courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course): RedirectResponse
    {
        $approvedEnrollments = $course->approvedEnrollments()->count();

        abort_if($approvedEnrollments > 0, 400, 'Cannot delete course with approved enrollments.');

        $this->courseRepository->delete($course);

        return redirect()->route('courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}
