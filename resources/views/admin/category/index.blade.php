@extends('layouts.backend.app')

@section('title', 'Category')

@section('main_content')
	<!-- start page title -->
	<div class="py-3 py-lg-4">
		<div class="row">
			<div class="col-lg-6">
				<h4 class="page-title mb-0">Categories</h4>
			</div>
			<div class="col-lg-6">
				<div class="d-none d-lg-block">
					<ol class="breadcrumb m-0 float-end">
						<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
						<li class="breadcrumb-item active">Categories</li>
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
				<h4 class="card-title">Categories</h4>
				<a href="{{ route('admin.category.create') }}" class="btn btn-success waves-effect"><i class="bx bxs-add-to-queue me-1"></i>Add Category</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table table-striped table-hover align-middle">
				<thead>
					<th>SL</th>
					<th>Category</th>
					<th>Product</th>
					<th>Status</th>
					<th>Creation</th>
					<th>Action</th>
				</thead>

				<tfoot>
					<th>SL</th>
					<th>Category</th>
					<th>Product</th>
					<th>Status</th>
					<th>Creation</th>
					<th>Action</th>
				</tfoot>

				<tbody>
					@forelse ($categories as $key => $category)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $category->category }}</td>
							<td>{{ getProductCategory($category->id) }}</td>
							<td>
								@if ($category->status == true)
									<span class="px-2 py-1 fw-bold rounded badge-soft-success">Active</span>
								@else
									<span class="px-2 py-1 fw-bold rounded badge-soft-danger">Inactive</span>
								@endif
							</td>
							<td><span class="px-2 py-1 fw-bold rounded badge-soft-danger">{{ $category->user->name }}</span></td>
							<td>
								<div class="d-flex align-items-center gap-1">
									<a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-success waves-effect"><i class="bx bx-edit-alt me-1"></i>Edit</a>
									<button class="btn btn-danger waves-effect category-delete" category-id="{{ $category->id }}" category-name="{{ $category->category }}"><i class="bx bx-trash me-1"></i>Delete</button>
								</div>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="12" class="text-center">Categories records found.!</td>
						</tr>
					@endforelse
				</tbody>


			</table>
			{{ $categories->links('layouts.backend.layouts.custome-pagination') }}
		</div>
	</div>

	<!-- Delete Modal -->
	<div class="modal fade bounceUpIn" id="categoryDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content p-3">
				<div class="modal-header">
					<h4 class="modal-title" id="categoryLabel">Delete Category</h4>
					<button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					This will delete <strong></strong>
				</div>
				<div class="modal-footer border-0">
					<button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><i class="bx bx-x-circle me-1"></i>Close</button>
					<form id="categoryDeleteForm" method="post">
						@csrf
						@method('DELETE')
						<button class="btn btn-danger waves-effect"><i class="bx bx-trash me-1"></i>Delete</button>
					</form>
				</div>
			</div>
		</div>
	</div>

@endsection


@push('js')
	<script>
		$('.category-delete').on('click', function() {
			$('#categoryDeleteModal').modal('show');
			var categoryID = $(this).attr('category-id');
			var categoryName = $(this).attr('category-name');
			var url = "/admin/category/" + categoryID;

			// alert(url);
			$('.modal-body strong').text(categoryName);
			$('#categoryDeleteForm').attr('action', url); // Set the form action
		});
	</script>
@endpush
