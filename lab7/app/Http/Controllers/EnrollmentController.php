<?php

namespace App\Http\Controllers;

use App\Actions\ApproveEnrollmentAction;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Models\Course;
use App\Models\Enrollment;
use App\Repositories\EnrollmentRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EnrollmentController extends Controller
{
    protected EnrollmentRepositoryInterface $enrollmentRepository;
    protected ApproveEnrollmentAction $approveEnrollmentAction;

    public function __construct(
        EnrollmentRepositoryInterface $enrollmentRepository,
        ApproveEnrollmentAction $approveEnrollmentAction
    ) {
        $this->enrollmentRepository = $enrollmentRepository;
        $this->approveEnrollmentAction = $approveEnrollmentAction;
    }

    public function create(): View
    {
        $courses = Course::orderBy('title')->get();
        return view('enrollments.create', compact('courses'));
    }

    public function store(StoreEnrollmentRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['status'] = 'pending';

        $this->enrollmentRepository->create($data);

        return redirect()->route('courses.index')
            ->with('success', 'Enrollment created successfully.');
    }

    public function approve(Enrollment $enrollment): RedirectResponse
    {
        $this->approveEnrollmentAction->execute($enrollment);

        return redirect()->back()
            ->with('success', 'Enrollment approved successfully.');
    }

    public function drop(Enrollment $enrollment): RedirectResponse
    {
        abort_if($enrollment->status !== 'approved', 400, 'Enrollment must be approved to drop.');

        $enrollment->update(['status' => 'dropped']);

        return redirect()->back()
            ->with('success', 'Enrollment dropped successfully.');
    }
}
