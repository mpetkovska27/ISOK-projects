@extends('layouts.app')

@section('content')
    <div class="container">

        <h2>Add Organizer</h2>

        <form method="POST" action="{{ route('organizers.store') }}">
            @csrf
            @include('organizers.form')

            <button class="btn btn-success mt-3">Submit</button>
        </form>

    </div>
@endsection
