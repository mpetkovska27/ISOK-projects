

@extends('layouts.app')

@section('content')
    <div class="container">

        <h2>Add Book</h2>

        <form method="POST" action="{{ route('books.store') }}">
            @csrf
            @include('books.form')

            <button class="btn btn-success mt-3">Submit</button>
        </form>

    </div>
@endsection
