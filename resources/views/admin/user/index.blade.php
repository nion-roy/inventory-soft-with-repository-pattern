@extends('layouts.backend.app')

@section('title', 'User')

@section('main_content')
	<!-- start page title -->
	<div class="py-3 py-lg-4">
		<div class="row">
			<div class="col-lg-6">
				<h4 class="page-title mb-0">Users</h4>
			</div>
			<div class="col-lg-6">
				<div class="d-none d-lg-block">
					<ol class="breadcrumb m-0 float-end">
						<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
						<li class="breadcrumb-item active">All Users</li>
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
				<h4 class="card-title">All Users</h4>
				<a href="{{ route('admin.user.create') }}" class="btn btn-success waves-effect"><i class="bx bxs-add-to-queue me-1"></i>Add User</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table table-striped table-hover align-middle">
				<thead>
					<th>SL</th>
					<th>Name</th>
					<th>Email</th>
					<th>Image</th>
					<th>Role</th>
					<th>Status</th>
					<th>Action</th>
				</thead>

				<tfoot>
					<th>SL</th>
					<th>Name</th>
					<th>Email</th>
					<th>Image</th>
					<th>Role</th>
					<th>Status</th>
					<th>Action</th>
				</tfoot>

				<tbody>
					@forelse ($users as $key => $user)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>
								@if ($user->image == 'user.png' && $user->image)
									<img src="{{ asset('default/user.png') }}" class="img-fluid img-thumbnail" width="40px" alt="{{ $user->name }}">
								@else
									<img src="{{ asset($user->image) }}" class="img-fluid img-thumbnail" width="40px" alt="{{ $user->name }}">
								@endif
							</td>
							<td><span class="px-2 py-1 fw-bold rounded badge-soft-danger">{{ $user->role }}</span></td>
							<td>
								@if ($user->status == 1)
									<span class="px-2 py-1 fw-bold rounded badge-soft-success">Active</span>
								@elseif ($user->status == 2)
									<span class="px-2 py-1 fw-bold rounded badge-soft-warning">Pending</span>
								@elseif ($user->status == 3)
									<span class="px-2 py-1 fw-bold rounded badge-soft-danger">Suspended</span>
								@elseif ($user->status == 4)
									<span class="px-2 py-1 fw-bold rounded badge-soft-danger">Blocked</span>
								@else
									<span class="px-2 py-1 fw-bold rounded badge-soft-danger">Inactive</span>
								@endif
							</td>
							<td>
								<div class="d-flex align-items-center gap-1">
									<a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-success waves-effect"><i class="bx bx-edit-alt me-1"></i>Edit</a>
									<button class="btn btn-danger waves-effect user-delete" user-id="{{ $user->id }}" user-name="{{ $user->name }}"><i class="bx bx-trash me-1"></i>Delete</button>
								</div>
							</td>
						</tr>

					@empty
						<tr>
							<td colspan="12" class="text-center">Users records not found.!</td>
						</tr>
					@endforelse
				</tbody>


			</table>
			{{-- {{ $users->links('layouts.backend.layouts.custome-pagination') }} --}}
		</div>
	</div>


	<!-- Delete Modal -->
	<div class="modal fade bounceUpIn" id="userDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content p-3">
				<div class="modal-header">
					<h4 class="modal-title" id="userLabel">Delete User</h4>
					<button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					This will delete <strong></strong>
				</div>
				<div class="modal-footer border-0">
					<button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><i class="bx bx-x-circle me-1"></i>Close</button>
					<form id="userDeleteForm" method="post">
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
		$('.user-delete').on('click', function() {
			$('#userDeleteModal').modal('show');
			var userID = $(this).attr('user-id');
			var userName = $(this).attr('user-name');
			var url = "/admin/user/" + userID;

			// alert(url);
			$('.modal-body strong').text(userName);
			$('#userDeleteForm').attr('action', url); // Set the form action
		});
	</script>
@endpush
