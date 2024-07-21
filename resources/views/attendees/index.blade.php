@extends('layouts.dashboard')

@section('title') Attendees | List @endsection

@section('content')
<div class="row mt-3">
    <div class="col-lg-12 col-md-12">
        <!-- Breadcrumb Items -->
        <div class="card custom-card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="text-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('events.index') }}">Events</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Attendees</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- List DataTable -->
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered" id="tickets-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Event Title</th>
                            <th>Ticket Type</th>
                            <th>Price</th>
                            <th>Payment</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        // --
        // Load Datatable
        $(document).ready(function() {
            $('#tickets-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('attendees.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'event_title', name: 'event_title' },
                    { data: 'ticket_type', name: 'ticket_type' },
                    { data: 'price', name: 'price' },
                    { data: 'payment', name: 'payment' }
                ]
            });
        });
    </script>
@endsection