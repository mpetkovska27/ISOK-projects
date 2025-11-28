
@extends('layouts.app')

@section('content')
    <div class="container">

        <h2>Edit Book</h2>

        <form method="POST" action="{{ route('books.update', $book) }}">
            @csrf
            @method('PUT')

            @include('books.form')

            <button class="btn btn-success mt-3">Submit</button>
        </form>

    </div>
@endsection
