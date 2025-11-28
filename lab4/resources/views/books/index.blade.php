@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('books.create')}}" class="btn btn-secondary mb-3">Add Book</a>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Year Published</th>
                    <th>ISBN</th>
                    <th>Genre</th>
                    <th>Borrowed By</th>
                    <th>Date Borrowed</th>
                    <th>Date Returned</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->year }}</td>
                    <td>{{ $book->isbn }}</td>
                    <td>{{ $book->genre }}</td>
                    <td>{{ $book->borrowed_by }}</td>
                    <td>{{ $book->borrowed_at }}</td>
                    <td>{{ $book->return_date }}</td>
                    <td>
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>


                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
            <strong>Book count:</strong> {{ $bookCount }} |
            <strong>Borrowed Book count:</strong> {{ $borrowedCount }}
        </div>
    </div>
