@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Course</h2>

        <form method="POST" action="{{ route('courses.update', $course) }}">
            @csrf
            @method('PUT')

            @include('courses.form')

            <button class="btn btn-success mt-3">Submit</button>
            <a href="{{ route('courses.index') }}" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>
@endsection
