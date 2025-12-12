@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <h1>Events</h1>
            </div>
            <div class="col-auto">
                <a href="{{ route('events.create') }}" class="btn btn-primary">Add Event</a>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <form method="GET" action="{{route('events.index')}}" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search" value="{{ $search }}">
                    <button type="submit" class="btn btn-secondary">Search</button>
                </form>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Date</th>
                <th>Organizer</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($events as $event)
                <tr>
                    <td>{{ $event->id }}</td>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->type }}</td>
                    <td>{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d') }}</td>
                    <td>
                        @if($event->organizer)
                            <a href="{{ route('organizers.show', $event->organizer) }}">{{ $event->organizer->name }}</a>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    <td>{{ \Illuminate\Support\Str::limit($event->description, 50) }}</td>
                    <td>
                        <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-secondary">View</a>
                        <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <form action="{{ route('events.destroy', $event) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this event?');">
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
            {{ $events->links('pagination::simple-bootstrap-5') }}
        </div>

    </div>
@endsection
