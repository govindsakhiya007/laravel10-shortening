@extends('layouts.dashboard')

@section('title') Organizer | Dashboard @endsection

@section('content')
<div class="row mt-3">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <h4>Ticket Sales and Statistics</h4>

                <div class="table-responsive">
                    <table id="ticket-sales-table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Event Title</th>
                                <th>Ticket Type</th>
                                <th>Price</th>
                                <th>Total Quantity</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        // --
        // Load Datatable
        $(document).ready(function() {
            var table = $('#ticket-sales-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('organizer.dashboard') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'event_title', name: 'event_title' },
                    { data: 'ticket_type', name: 'ticket_type' },
                    { data: 'price', name: 'price' },
                    { data: 'total_quantity', name: 'total_quantity' },
                    { data: 'total_price', name: 'total_price' }
                ]
            });
        });

    </script>
@endsection
