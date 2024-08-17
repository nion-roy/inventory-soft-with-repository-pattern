@if (session('success'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<strong>Success!</strong> {{ session('success') }}
	</div>
@endif
@if (session('error'))
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<strong>Error!</strong> {{ session('error') }}
	</div>
@endif
@if (session('warning'))
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
		<strong>Warning!</strong> {{ session('warning') }}
		{{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
	</div>
@endif


<script>
	window.setTimeout(function() {
		$(".alert").fadeTo(500, 0).slideUp(500, function() {
			$(this).remove();
		});
	}, 4000);
</script>
