@extends('layouts.backend.app')

@section('title', 'Brand')

@section('main_content')
	<!-- start page title -->
	<div class="py-3 py-lg-4">
		<div class="row">
			<div class="col-lg-6">
				<h4 class="page-title mb-0">Brands</h4>
			</div>
			<div class="col-lg-6">
				<div class="d-none d-lg-block">
					<ol class="breadcrumb m-0 float-end">
						<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
						<li class="breadcrumb-item active">Brands</li>
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
				<h4 class="card-title">Brands</h4>
				<a href="{{ route('admin.brand.create') }}" class="btn btn-success waves-effect"><i class="bx bxs-add-to-queue me-1"></i>Add Brand</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table table-striped table-hover align-middle">
				<thead>
					<th>SL</th>
					<th>Brand</th>
					<th>Image</th>
					<th>Product</th>
					<th>Status</th>
					<th>Creation</th>
					<th>Action</th>
				</thead>

				<tfoot>
					<th>SL</th>
					<th>Brand</th>
					<th>Image</th>
					<th>Product</th>
					<th>Status</th>
					<th>Creation</th>
					<th>Action</th>
				</tfoot>

				<tbody>
					@forelse ($brands as $key => $brand)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $brand->brand }}</td>
							<td><img src="{{ asset($brand->image) }}" class="img-fluid img-thumbnail" width="40px" alt="{{ $brand->brand }}"></td>
							<td>{{ getProductBrand($brand->id) }}</td>
							<td>
								@if ($brand->status == true)
									<span class="px-2 py-1 fw-bold rounded badge-soft-success">Active</span>
								@else
									<span class="px-2 py-1 fw-bold rounded badge-soft-danger">Inactive</span>
								@endif
							</td>
							<td><span class="px-2 py-1 fw-bold rounded badge-soft-danger">{{ $brand->user->name }}</span></td>
							<td>
								<div class="d-flex align-items-center gap-1">
									<a href="{{ route('admin.brand.edit', $brand->id) }}" class="btn btn-success waves-effect"><i class="bx bx-edit-alt me-1"></i>Edit</a>
									<button class="btn btn-danger waves-effect brand-delete" brand-id="{{ $brand->id }}" brand-name="{{ $brand->brand }}"><i class="bx bx-trash me-1"></i>Delete</button>
								</div>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="12" class="text-center">Brands records not found.!</td>
						</tr>
					@endforelse
				</tbody>

			</table>
			{{ $brands->links('layouts.backend.layouts.custome-pagination') }}
		</div>
	</div>

	<!-- Delete Modal -->
	<div class="modal fade bounceUpIn" id="brandDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content p-3">
				<div class="modal-header">
					<h4 class="modal-title" id="brandLabel">Delete Brand</h4>
					<button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					This will delete <strong></strong>
				</div>
				<div class="modal-footer border-0">
					<button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><i class="bx bx-x-circle me-1"></i>Close</button>
					<form id="brandDeleteForm" method="post">
						@csrf
						@method('DELETE')
						<button class="btn btn-danger waves-effect"><i class="bx bx-trash me-1"></i>Delete</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Delete Modal -->

@endsection


@push('js')
	<script>
		$('.brand-delete').on('click', function() {
			$('#brandDeleteModal').modal('show');
			var brandID = $(this).attr('brand-id');
			var brandName = $(this).attr('brand-name');
			var url = "/admin/brand/" + brandID;

			// alert(url);
			$('.modal-body strong').text(brandName);
			$('#brandDeleteForm').attr('action', url); // Set the form action
		});
	</script>
@endpush
