
<div class="d-flex">
	<!-- Edit button -->
	<a href="{{ route('urls.edit', $url->id) }}" class="btn btn-sm btn-primary">
		Edit
	</a>&nbsp;&nbsp;

	<a href="javascript:void(0);" onclick="deleteURLS({{ $url->id }})" class="btn btn-sm btn-danger">
		Delete
	</a>

	<!-- Delete button -->
	<form method="POST" action="{{ route('urls.destroy', $url->id) }}" style="display: none;" id="delete-form-{{ $url->id }}">
		@csrf
		@method('DELETE')
		<button type="submit" class="btn btn-sm btn-danger"></button>
	</form>

	<!-- Deactivate button -->
	@if($url->is_active)
		<form method="POST" action="{{ route('deactivate.url', $url->id) }}">
			@csrf
			&nbsp;&nbsp;<button type="submit" class="btn btn-sm btn-secondary">Deactivate</button>
		</form>
	@endif
</div>
