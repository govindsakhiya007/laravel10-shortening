@extends('layouts.dashboard')

@section('title') Events | Upcoming @endsection

@section('content')
<div class="row mt-3">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="container mt-4">
                    <h1>Upcoming Events</h1>
                    <div class="row">
                        @if(count($upcomingEvents) > 0)
                            @foreach ($upcomingEvents as $event)
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="card p-3">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $event->title }}</h5>
                                            <p class="card-text">{{ $event->description }}</p>
                                            <p class="text-muted"><strong>Location:</strong> {{ $event->location }}</p>
                                            <p class="text-muted"><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }}</p>
                                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-lg-12 col-md-12 mb-4">
                                <div class="card p-3">
                                    <div class="card-body text-center">
                                        <h3>There are no upcoming events.</h3>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection