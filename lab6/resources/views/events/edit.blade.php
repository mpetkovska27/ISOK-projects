@extends('layouts.app')

@section('content')
    <div class="container">

        <h2>Edit Event</h2>

        <form method="POST" action="{{ route('events.update', $event) }}">
            @csrf
            @method('PUT')

            @include('events.form')

            <button class="btn btn-success mt-3">Submit</button>
        </form>

    </div>
@endsection
