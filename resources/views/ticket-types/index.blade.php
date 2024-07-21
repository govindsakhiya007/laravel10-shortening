@extends('layouts.dashboard')

@section('title') Ticket Types | List @endsection

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
                                    <a href="#">Ticket Types</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <!--  List Datatable -->
            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="events-types-table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Created</th>
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
    <script type="text/javascript">
		$(document).ready(function () {
            // --
            // Load Datatable
			$('#events-types-table').DataTable({
				processing: true,
				serverSide: true,
				ajax: '{{ route('ticket-types.index') }}',
				columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
					{ data: 'name', name: 'name' },
					{ data: 'price', name: 'price' },
					{ data: 'quantity', name: 'quantity' },
					{ data: 'created_at', name: 'created_at' }
				],
				order: [[4, 'desc']],
			});
		});
	</script>
@endsection
