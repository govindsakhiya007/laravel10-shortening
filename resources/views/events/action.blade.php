
<div class="d-flex">
	<!-- View button -->
	<a href="{{ route('events.show', $event->id) }}" class="btn btn-sm btn-secondary">
		<i class="far fa-eye"></i>
	</a>&nbsp;&nbsp;

	@if($user->role == 1)
		<!-- Edit button -->
		<a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-primary">
			<i class="far fa-edit"></i>
		</a>&nbsp;&nbsp;

		<!-- Delete button -->
		<a href="javascript:void(0);" onclick="deleteRecord({{ $event->id }})" class="btn btn-sm btn-danger">
			<i class="far fa-trash-alt"></i>
		</a>
	@endif

	<!-- Delete button -->
	<form method="POST" action="{{ route('events.destroy', $event->id) }}" style="display: none;" id="delete-form-{{ $event->id }}">
		@csrf
		@method('DELETE')
		<button type="submit" class="btn btn-sm btn-danger"></button>
	</form>
</div>
