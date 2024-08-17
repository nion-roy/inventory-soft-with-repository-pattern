@extends('layouts.backend.app')

@section('title', 'Edit User')

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
						<li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Users</a></li>
						<li class="breadcrumb-item active">Edit User</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<!-- end page title -->

	@include('alert-message.alert-message')

	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Edit User</h4>
		</div>
		<div class="card-body">
			<form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<div class="row mb-3">
					<label for="name" class="col-sm-3 col-form-label">User Name</label>
					<div class="col-sm-9">
						<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter user name" value="{{ old('name') ?? $user->name }}">
						@error('name')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="row mb-3">
					<label for="email" class="col-sm-3 col-form-label">Email</label>
					<div class="col-sm-9">
						<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email editress" value="{{ old('email') ?? $user->email }}">
						@error('email')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="row mb-3">
					<label for="password" class="col-sm-3 col-form-label">Password</label>
					<div class="col-sm-9">
						<input type="text" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter password" value="12345678">
						@error('password')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="row mb-3">
					<label for="image" class="col-sm-3 col-form-label">Image</label>
					<div class="col-sm-9">
						<input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
						@error('image')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div class="row justify-content-end mb-3">
					<div class="col-sm-9">
						<div class="d-flex align-items-center gap-3">
							<div class="form-check">
								<input class="form-check-input" type="radio" name="status" id="active" value="1" {{ $user->status == 1 ? 'checked' : '' }}>
								<label class="form-check-label" for="active">Active</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="status" id="pending" value="2" {{ $user->status == 2 ? 'checked' : '' }}>
								<label class="form-check-label" for="pending">Pending</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="status" id="suspended" value="3" {{ $user->status == 3 ? 'checked' : '' }}>
								<label class="form-check-label" for="suspended">Suspended</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="status" id="blocked" value="4" {{ $user->status == 4 ? 'checked' : '' }}>
								<label class="form-check-label" for="blocked">Blocked</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="status" id="inactive" value="5" {{ $user->status == 5 ? 'checked' : '' }}>
								<label class="form-check-label" for="inactive">Inactive</label>
							</div>
						</div>
					</div>
				</div>

				<div class="justify-content-end row">
					<div class="col-sm-9">
						<a href="{{ route('admin.user.index') }}" class="btn btn-danger waves-effect"><i class="bx bx-left-arrow-circle me-1"></i>Back</a>
						<button type="submit" class="btn btn-success waves-effect"><i class="bx bx-upload me-1"></i>Update Now</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection
