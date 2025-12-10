@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Event Details</h2>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Event Information</h5>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">ID:</dt>
                    <dd class="col-sm-9">{{ $event->id }}</dd>

                    <dt class="col-sm-3">Name:</dt>
                    <dd class="col-sm-9">{{ $event->name }}</dd>

                    <dt class="col-sm-3">Description:</dt>
                    <dd class="col-sm-9">{{ $event->description }}</dd>

                    <dt class="col-sm-3">Type:</dt>
                    <dd class="col-sm-9">{{ $event->type }}</dd>

                    <dt class="col-sm-3">Date:</dt>
                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($event->date)->format('Y-m-d') }}</dd>

                    <dt class="col-sm-3">Organizer:</dt>
                    <dd class="col-sm-9">
                        @if($event->organizer)
                            <a href="{{ route('organizers.show', $event->organizer) }}">{{ $event->organizer->name }}</a>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </dd>

                    <dt class="col-sm-3">Created At:</dt>
                    <dd class="col-sm-9">{{ $event->created_at->format('Y-m-d H:i:s') }}</dd>

                    <dt class="col-sm-3">Updated At:</dt>
                    <dd class="col-sm-9">{{ $event->updated_at->format('Y-m-d H:i:s') }}</dd>
                </dl>
            </div>
        </div>
    </div>
@endsection
