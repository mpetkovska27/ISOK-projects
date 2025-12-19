@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Course Details</h2>

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Course Information</h5>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">ID:</dt>
                    <dd class="col-sm-9">{{ $course->id }}</dd>

                    <dt class="col-sm-3">Title:</dt>
                    <dd class="col-sm-9">{{ $course->title }}</dd>

                    <dt class="col-sm-3">Summary:</dt>
                    <dd class="col-sm-9">{{ $course->summary }}</dd>

                    <dt class="col-sm-3">Level:</dt>
                    <dd class="col-sm-9">
                        {{ ucfirst($course->level) }}
                    </dd>

                    <dt class="col-sm-3">Start Date:</dt>
                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($course->start_date)->format('Y-m-d') }}</dd>

                    <dt class="col-sm-3">Seats:</dt>
                    <dd class="col-sm-9">{{ $course->seats }}</dd>

                    <dt class="col-sm-3">Created At:</dt>
                    <dd class="col-sm-9">{{ $course->created_at->format('Y-m-d H:i:s') }}</dd>

                    <dt class="col-sm-3">Updated At:</dt>
                    <dd class="col-sm-9">{{ $course->updated_at->format('Y-m-d H:i:s') }}</dd>
                </dl>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Enrollments</h5>
                <a href="{{ route('enrollments.create') }}?course_id={{ $course->id }}" class="btn btn-sm btn-primary">Add Enrollment</a>
            </div>
            <div class="card-body">
                @if($course->enrollments->count() > 0)
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student Name</th>
                            <th>Seats Requested</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($course->enrollments as $enrollment)
                            <tr>
                                <td>{{ $enrollment->id }}</td>
                                <td>{{ $enrollment->student_name }}</td>
                                <td>{{ $enrollment->seats_requested }}</td>
                                <td>
                                    {{ ucfirst($enrollment->status) }}
                                </td>
                                <td>
                                    @if($enrollment->status === 'pending')
                                        <form action="{{ route('enrollments.approve', $enrollment) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                        </form>
                                    @endif
                                    @if($enrollment->status === 'approved')
                                        <form action="{{ route('enrollments.drop', $enrollment) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to drop this enrollment?');">Drop</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">No enrollments yet.</p>
                @endif
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('courses.index') }}" class="btn btn-secondary">Back to Courses</a>
            <a href="{{ route('courses.edit', $course) }}" class="btn btn-primary">Edit Course</a>
        </div>
    </div>
@endsection
