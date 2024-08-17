@extends('layouts.backend.app')

@section('title', 'Tax')

@section('main_content')
	<!-- start page title -->
	<div class="py-3 py-lg-4">
		<div class="row">
			<div class="col-lg-6">
				<h4 class="page-title mb-0">Taxs</h4>
			</div>
			<div class="col-lg-6">
				<div class="d-none d-lg-block">
					<ol class="breadcrumb m-0 float-end">
						<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
						<li class="breadcrumb-item active">Taxs</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<!-- end page title -->

	@include('alert-message.alert-message')

	<div class="card">
		<div class="card-header">
			<div class="d-flex align-items-center justify-content-between">
				<h4 class="card-title">Taxs</h4>
				<button class="btn btn-success waves-effect" data-bs-toggle="modal" data-bs-target="#taxAddModal"><i class="bx bxs-add-to-queue me-1"></i>Add Tax</button>
			</div>
		</div>
		<div class="card-body">
			<table class="table table-striped table-hover align-middle">
				<thead>
					<th>SL</th>
					<th>Tax Name</th>
					<th>Rate (%)</th>
					<th>Status</th>
					<th>Creation</th>
					<th>Action</th>
				</thead>

				<tfoot>
					<th>SL</th>
					<th>Tax Name</th>
					<th>Rate (%)</th>
					<th>Status</th>
					<th>Creation</th>
					<th>Action</th>
				</tfoot>

				<tbody>
					@forelse ($taxes as $key => $tax)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $tax->name }}</td>
							<td>{{ $tax->tax }}</td>
							<td>
								@if ($tax->status == true)
									<span class="px-2 py-1 fw-bold rounded badge-soft-success">Active</span>
								@else
									<span class="px-2 py-1 fw-bold rounded badge-soft-danger">Inactive</span>
								@endif
							</td>
							<td><span class="px-2 py-1 fw-bold rounded badge-soft-danger">{{ $tax->user->name }}</span></td>
							<td>
								<div class="d-flex align-items-center gap-1 tax-action">
									<button class="btn btn-success waves-effect tax-edit" tax-id="{{ $tax->id }}" data-bs-toggle="modal" data-bs-target="#taxEditModal"><i class="bx bx-edit-alt me-1"></i>Edit</button>
									<button class="btn btn-danger waves-effect tax-delete" tax-id="{{ $tax->id }}" tax-name="{{ $tax->name }}"><i class="bx bx-trash me-1"></i>Delete</button>
								</div>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="12" class="text-center">Taxs records not found.!</td>
						</tr>
					@endforelse
				</tbody>

			</table>
			{{ $taxes->links('layouts.backend.layouts.custome-pagination') }}
		</div>
	</div>


	@include('admin.tax.delete-modal')

	@include('admin.tax.create')

	@include('admin.tax.edit')

	@push('js')
		<script>
			// Tax added function with ajax
			$('#addTaxButton').on('click', function() {
				var formData = {
					name: $("#name_add").val(),
					tax: $("#tax_add").val(),
					status: $("#status_add").is(":checked") ? 1 : 0,
				};

				// Clear previous error messages
				$(".is-invalid").removeClass("is-invalid");
				$(".invalid-feedback").remove();

				$.ajax({
					type: "POST",
					url: "/admin/tax",
					data: formData,
					success: function(response) {
						window.location.href = response.redirect;
					},

					error: function(xhr, status, error) {
						var errors = xhr.responseJSON;
						$.each(errors.errors, function(key, value) {
							$("#" + key + "_add").addClass("is-invalid");
							$("#" + key + "_add").after('<span class="invalid-feedback text-danger">' + value[0] + "</span>");
						});
					},

				});
			});
			// Tax added function with ajax

			// Tax edit with ajax
			$('.tax-edit').on('click', function() {
				var taxID = $(this).attr('tax-id');
				var url = "/admin/tax/" + taxID + "/edit";
				$.ajax({
					url: url,
					type: "GET",
					success: function(response) {
						$("#name_edit").val(response.tax.name);
						$("#tax_edit").val(response.tax.tax);
						$("#status_edit").prop("checked", response.tax.status == 1);
						// Call updateTax with taxID
						updateTax(taxID);
					}
				});
			});
			// Tax edit with ajax

			// Tax edit to update with ajax
			function updateTax(taxID) {
				// Assign click event handler outside the previous click event
				$('#updateTaxButton').off('click').on('click', function() {
					var url = "/admin/tax/" + taxID;
					var formData = {
						name: $("#name_edit").val(),
						tax: $("#tax_edit").val(),
						status: $("#status_edit").is(":checked") ? 1 : 0,
					};

					//Clear previous error messages
					$(".is-invalid").removeClass("is-invalid");
					$(".invalid-feedback").remove();

					var url = "/admin/tax/" + taxID;

					$.ajax({
						url: url,
						type: "PUT",
						data: formData,
						success: function(response) {
							window.location.href = response.redirect;
						},

						error: function(xhr, status, error) {
							var errors = xhr.responseJSON;
							$.each(errors.errors, function(key, value) {
								$("#" + key + "_edit").addClass("is-invalid");
								$("#" + key + "_edit").after('<span class="invalid-feedback text-danger">' + value[0] + "</span>");
							});
						},

					});
				});
			}
			// Tax edit to update with ajax
		</script>
	@endpush


@endsection



@push('js')
	<script>
		$('.tax-delete').on('click', function() {
			$('#taxDeleteModal').modal('show');
			var taxID = $(this).attr('tax-id');
			var taxName = $(this).attr('tax-name');
			var url = "/admin/tax/" + taxID;

			// alert(url);
			$('.modal-body strong').text(taxName);
			$('#taxDeleteForm').attr('action', url); // Set the form action
		});
	</script>
@endpush
