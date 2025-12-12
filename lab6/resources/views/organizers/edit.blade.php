@extends('layouts.app')

@section('content')
    <div class="container">

        <h2>Edit Organizer</h2>

        <form method="POST" action="{{ route('organizers.update', $organizer) }}">
            @csrf
            @method('PUT')

            @include('organizers.form')

            <button class="btn btn-success mt-3">Submit</button>
        </form>

    </div>
@endsection
