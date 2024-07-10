@extends('layouts.dashboard')
@section('title') Shortened URLs | List @endsection
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
                                <a href="{{ route('urls.index') }}">Shortened URLs / List</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Geckos List Layouts-->
        <div class="card custom-card">
            <div class="card-body">
                <form id="shorten-url-form">
                    @csrf
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <input type="url" name="original_url" class="form-control" placeholder="Enter URL to shorten">
                                <div id="original_url_error" class="text-danger">@error('original_url'){{ $message }}@enderror</div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary btn-block">Shorten</button>
                        </div>
                    </div>
                </form>
                
                <div class="table-responsive">
                    <table id="urls-table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Original URL</th>
                                <th>Short URL</th>
                                <th>Status</th>
                                <th>Created Date</th>
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
        function deleteURLS(id) {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this Gecko!",
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

    $(document).ready(function () {
        // --
        // URLs datatables
        $('#urls-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('urls.index') }}',
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'original_url', name: 'original_url' },
                { data: 'short_url', name: 'short_url' },
                { data: 'is_active', name: 'is_active' },
                { data: 'created_at', name: 'created_at' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            order: [[4, 'desc']],
        });

        // --
        // Validate URLs form
        var isValid = false;
        $("#shorten-url-form").validate({
            rules: {
                original_url: {
                    required: true,
                    url: true
                }
            },
            messages: {
                original_url: {
                    required: 'Please enter a URL.',
                    url: 'Please enter a valid URL.'
                }
            },
            errorPlacement: function (error, element) {
                var name = element.attr('name');
                error.appendTo($('#' + name + '_error'));
            },
            submitHandler: function (form) {
                isValid = true;
            }
        });

        // --
        // Submit URLs form
        $('#shorten-url-form').on('submit', function (e) {
            if(isValid) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('urls.store') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if(response.error) {
                            showToast(response.error, 'error');
                        } else {
                            showToast('URL created successfully.', 'success');
                            $('#urls-table').DataTable().ajax.reload();
                        }
                    },
                    error: function(response) {
                        if(response.status === 403) {
                            showToast(response.responseJSON.error, 'error');
                        }
                    }
                });
            }
        });
    });

    // --
    // Show toaster for error/success message
    function showToast(message, type) {
        var toastMessage = document.getElementById('toast-message');
        var toastElement = document.getElementById('toast-urls');

        // Reset classes
        toastMessage.className = 'toast-body text-white p-3';

        if (type === 'success') {
            toastMessage.classList.add('bg-primary');
        } else if (type === 'error') {
            toastMessage.classList.add('bg-secondary');
        }

        // Set the message
        toastMessage.innerText = message;

        // Show the toast
        var toast = new bootstrap.Toast(toastElement);
        toast.show();

        // Hide the toast after 5 seconds
        setTimeout(function(){
            toast.hide();
        }, 5000);
    }
</script>
@endsection
