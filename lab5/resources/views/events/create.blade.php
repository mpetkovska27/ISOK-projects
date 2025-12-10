@extends('layouts.app')

@section('content')
    <div class="container">

        <h2>Add Event</h2>

        <form method="POST" action="{{ route('events.store') }}">
            @csrf
            @include('events.form')

            <button class="btn btn-success mt-3">Submit</button>
        </form>

    </div>
@endsection
