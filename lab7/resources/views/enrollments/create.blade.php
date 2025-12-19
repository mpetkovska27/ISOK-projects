@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Enrollment</h2>

        <form method="POST" action="{{ route('enrollments.store') }}">
            @csrf

            <div class="mb-3">
                <label for="course_id" class="form-label">Course <span class="text-danger">*</span></label>
                <select class="form-select @error('course_id') is-invalid @enderror" id="course_id" name="course_id" required>
                    <option value="">Select a course</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id', request('course_id')) == $course->id ? 'selected' : '' }}>
                            {{ $course->title }} ({{ ucfirst($course->level) }})
                        </option>
                    @endforeach
                </select>
                @error('course_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="student_name" class="form-label">Student Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('student_name') is-invalid @enderror" id="student_name" name="student_name" value="{{ old('student_name') }}" required>
                @error('student_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="seats_requested" class="form-label">Seats Requested <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('seats_requested') is-invalid @enderror" id="seats_requested" name="seats_requested" value="{{ old('seats_requested') }}" min="1" required>
                @error('seats_requested')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-success mt-3">Submit</button>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>
@endsection
