@extends('layouts.dashboard')

@section('title') Events | Detail @endsection

@section('content')
<div class="container mt-4">
    <!-- Event Details -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $event->title }}</h3>
                    @if(Auth::user()->role == 2)
                        <div class="float-end">
                            <a href="{{ route('tickets.purchase', $event->id) }}" class="btn btn-sm btn-secondary">
                                Purchase Ticket
                            </a>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <p><strong>Description:</strong> {{ $event->description }}</p>
                    <p><strong>Location:</strong> {{ $event->location }}</p>
                    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->date)->format('F j, Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Ticket Types and Availability -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <h4>Ticket Types</h4>
            <div class="row">
                @foreach ($ticketTypes as $ticketType)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card p-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $ticketType->name }}</h5>
                                <p><strong>Price:</strong> ${{ number_format($ticketType->price, 2) }}</p>
                                <p><strong>Available Quantity:</strong> {{ $ticketType->quantity }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Comments and Questions -->
    <div class="row mt-2 mb-2">
        <div class="col-lg-12">
            <h4>Comments and Questions</h4>
            <form method="POST" action="{{ route('events.comment', encrypt($event->id)) }}">
                @csrf
                <div class="form-group">
                    <label for="comment">Leave a comment or ask a question:</label>
                    <textarea id="comment" name="comment" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
