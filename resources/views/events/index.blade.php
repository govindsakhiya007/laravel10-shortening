@extends('layouts.dashboard')

@section('title') Events | List @endsection

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
                                    <a href="#">Events</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                    @if(Auth::user()->role == 1)
                        <div class="float-right">
                            <a href="{{ route('events.create') }}" class="btn btn-primary btn-block">Create</a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- List DataTable -->
            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="events-table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Location</th>
                                    <th>Ticket Availability</th>
                                    <th>Created</th>
                                    <th>Actions</th>
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
        // --
        // Swal popup for confirmation when delete
        function deleteRecord(id) {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                    cancelButton: 'btn btn-danger '
                }
            }, function () {
                document.getElementById('delete-form-' + id).submit();
            });
        }

        // --
        // Load Datatable
		$(document).ready(function () {
			$('#events-table').DataTable({
				processing: true,
				serverSide: true,
				ajax: '{{ route('events.index') }}',
				columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
					{ data: 'title', name: 'title' },
					{ data: 'description', name: 'description' },
					{ data: 'date', name: 'date' },
					{ data: 'location', name: 'location' },
					{ data: 'ticket_availability', name: 'ticket_availability' },
					{ data: 'created_at', name: 'created_at' },
					{ data: 'actions', name: 'actions', orderable: false, searchable: false }
				],
				order: [[6, 'desc']],
                dom: 'Bftip',
                buttons: [
                    'excelHtml5'
                ]
			});
		});    
	</script>
@endsection