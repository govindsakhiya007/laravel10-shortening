@extends('layouts.dashboard')

@section('title') Events | {{ isset($event) ? 'Edit' : 'Create' }} @endsection

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
                                    <a href="#">{{ isset($event) ? 'Edit' : 'Create' }}</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ isset($event) ? route('events.update', $event->id) : route('events.store') }}" method="POST" id="createEditEventForm">
                        @csrf
						@if(isset($event))
							@method('PUT')
						@endif
                        
                        <div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="title">Title</label>
									<input type="text" name="title" class="form-control" id="title" value="{{ isset($event) ? $event->title : old('title') }}" placeholder="Enter Title" />
									<div id="title_error" class="text-danger">@error('title'){{ $message }}@enderror</div>
								</div>
								<div class="form-group">
									<label for="date">Date</label>
									<input type="date" name="date" class="form-control" id="date" value="{{ isset($event) ? $event->date : old('date') }}" placeholder="Select Date" />
									<div id="date_error" class="text-danger">@error('date'){{ $message }}@enderror</div>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label for="location">Location</label>
									<input type="text" name="location" class="form-control" id="location" value="{{ isset($event) ? $event->location : old('location') }}" placeholder="Enter Location" />
									<div id="location_error" class="text-danger">@error('location'){{ $message }}@enderror</div>
								</div>
								<div class="form-group">
									<label for="ticket_availability">Ticket Availability</label>
									<input type="number" name="ticket_availability" class="form-control" id="ticket_availability" value="{{ isset($event) ? $event->ticket_availability : old('ticket_availability') }}" placeholder="0"/>
									<div id="ticket_availability_error" class="text-danger">@error('ticket_availability'){{ $message }}@enderror</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="description">Description</label>
									<textarea class="form-control" id="description" name="description">{{ isset($event) ? $event->description : old('description') }}</textarea>
									<div id="description_error" class="text-danger">@error('location'){{ $message }}@enderror</div>
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-primary">{{ isset($event) ? 'Update' : 'Create' }}</button>
								</div>
							</div>
						</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
	<!-- Script -->
	<script>
		$(document).ready(function() {
			$('#createEditEventForm').validate({
				rules: {
					title: {
						required: true,
						maxlength: 255
					},
					description: {
						required: true
					},
					date: {
						required: true,
						date: true
					},
					location: {
						required: true,
						maxlength: 255
					},
					ticket_availability: {
						required: true,
						digits: true,
						min: 1
					}
				},
				messages: {
					title: {
						required: "Please enter a title.",
						maxlength: "Title must not exceed 255 characters."
					},
					description: {
						required: "Please enter a description."
					},
					date: {
						required: "Please enter a date.",
						date: "Please enter a valid date."
					},
					location: {
						required: "Please enter a location.",
						maxlength: "Location must not exceed 255 characters."
					},
					ticket_availability: {
						required: "Please enter ticket availability.",
						digits: "Please enter a valid number.",
						min: "Ticket availability must be at least 1."
					}
				},
				errorPlacement: function(error, element) {
					var name = element.attr('name');
					error.appendTo($('#' + name + '_error'));
				},
				submitHandler: function(form) {
					var formData = $(form).serialize();

					// --
					// Submit form
					$.ajax({
						type: $(form).attr('method'),
						url: $(form).attr('action'),
						data: formData,
						dataType: 'json',
						success: function(response) {
							showToast(response.message, 'success');
							window.location.href = response.redirect; 
						},
						error: function(xhr, status, error) {
							var errors = xhr.responseJSON.errors;
							$.each(errors, function(key, value) {
								$('#' + key + '_error').text(value);
							});
						}
					});

					return false;
				}
			});
		});
	</script>
@endsection
