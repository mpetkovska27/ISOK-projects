@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Organizer Details</h2>

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Organizer Information</h5>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">ID:</dt>
                    <dd class="col-sm-9">{{ $organizer->id }}</dd>

                    <dt class="col-sm-3">Name:</dt>
                    <dd class="col-sm-9">{{ $organizer->name }}</dd>

                    <dt class="col-sm-3">Email:</dt>
                    <dd class="col-sm-9">{{ $organizer->email }}</dd>

                    <dt class="col-sm-3">Phone:</dt>
                    <dd class="col-sm-9">{{ $organizer->phone }}</dd>

                    <dt class="col-sm-3">Created At:</dt>
                    <dd class="col-sm-9">{{ $organizer->created_at->format('Y-m-d H:i:s') }}</dd>

                    <dt class="col-sm-3">Updated At:</dt>
                    <dd class="col-sm-9">{{ $organizer->updated_at->format('Y-m-d H:i:s') }}</dd>
                </dl>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Events ({{ $organizer->events->count() }})</h5>
            </div>
            <div class="card-body">
                @if($organizer->events->count() > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($organizer->events as $event)
                                <tr>
                                    <td>{{ $event->id }}</td>
                                    <td>{{ $event->name }}</td>
                                    <td>{{ $event->type }}</td>
                                    <td>{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d') }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($event->description, 50) }}</td>
                                    <td>
                                        <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-secondary">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted mb-0">This organizer has no events yet.</p>
                @endif
            </div>
        </div>
    </div>
@endsection

