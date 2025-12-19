@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <h1>Courses</h1>
            </div>
            <div class="col-auto">
                <a href="{{ route('courses.create') }}" class="btn btn-primary">Add Course</a>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <form method="GET" action="{{ route('courses.index') }}" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search by title" value="{{ $search }}">
                    <button type="submit" class="btn btn-secondary">Search</button>
                </form>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Level</th>
                <th>Start Date</th>
                <th>Seats</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->id }}</td>
                    <td>{{ $course->title }}</td>
                    <td>
                        {{ ucfirst($course->level) }}
                    </td>
                    <td>{{ \Carbon\Carbon::parse($course->start_date)->format('Y-m-d') }}</td>
                    <td>{{ $course->seats }}</td>
                    <td>
                        <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-secondary">View</a>
                        <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this course?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-3">
            {{ $courses->links('pagination::simple-bootstrap-5') }}
        </div>
    </div>
@endsection
