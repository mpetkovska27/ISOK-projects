@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <h1>Organizers</h1>
            </div>
            <div class="col-auto">
                <a href="{{ route('organizers.create') }}" class="btn btn-primary">Add Organizer</a>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($organizers as $organizer)
                <tr>
                    <td>{{ $organizer->id }}</td>
                    <td>{{ $organizer->name }}</td>
                    <td>{{ $organizer->email }}</td>
                    <td>{{ $organizer->phone }}</td>
                    <td>
                        <a href="{{ route('organizers.show', $organizer) }}" class="btn btn-sm btn-secondary">View</a>
                        <a href="{{ route('organizers.edit', $organizer) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <form action="{{ route('organizers.destroy', $organizer) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this organizer?');">
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
            {{ $organizers->links('pagination::simple-bootstrap-5') }}
        </div>

    </div>
@endsection

