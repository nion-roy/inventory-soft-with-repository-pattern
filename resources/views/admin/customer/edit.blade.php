@extends('layouts.backend.app')

@section('title', 'Edit Customer')

@section('main_content')
	<!-- start page title -->
	<div class="py-3 py-lg-4">
		<div class="row">
			<div class="col-lg-6">
				<h4 class="page-title mb-0">Cutomers</h4>
			</div>
			<div class="col-lg-6">
				<div class="d-none d-lg-block">
					<ol class="breadcrumb m-0 float-end">
						<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="{{ route('admin.customer.index') }}">Cutomers</a></li>
						<li class="breadcrumb-item active">Edit Customer</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<!-- end page title -->

	@include('alert-message.alert-message')

	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Edit Customer</h4>
		</div>
		<div class="card-body">
			<form action="{{ route('admin.customer.update', $customer->id) }}" method="POST">
				@csrf
				@method('PUT')

				<div class="row mb-3">
					<label for="name" class="col-sm-3 col-form-label">Customer Name</label>
					<div class="col-sm-9">
						<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter customer name" value="{{ old('name') ?? $customer->name }}">
						@error('name')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="row mb-3">
					<label for="email" class="col-sm-3 col-form-label">Email</label>
					<div class="col-sm-9">
						<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email editress" value="{{ old('email') ?? $customer->email }}">
						@error('email')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="row mb-3">
					<label for="contact" class="col-sm-3 col-form-label">Contact Number</label>
					<div class="col-sm-9">
						<input type="number" name="contact" class="form-control @error('contact') is-invalid @enderror" id="contact" placeholder="Enter contact number" value="{{ old('contact') ?? $customer->contact }}">
						@error('contact')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="row mb-3">
					<label for="address" class="col-sm-3 col-form-label">Address</label>
					<div class="col-sm-9">
						<input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Enter address" value="{{ old('address') ?? $customer->address }}">
						@error('address')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="row justify-content-end mb-3">
					<div class="col-sm-9">
						<div class="form-check">
							<input type="checkbox" name="status" class="form-check-input" id="status" {{ $customer->status == true ? 'checked' : '' }}>
							<label class="form-check-label" for="status">Active</label>
						</div>
					</div>
				</div>
				<div class="justify-content-end row">
					<div class="col-sm-9">
						<a href="{{ route('admin.customer.index') }}" class="btn btn-danger waves-effect"><i class="bx bx-left-arrow-circle me-1"></i>Back</a>
						<button type="submit" class="btn btn-success waves-effect"><i class="bx bx-upload me-1"></i>Update Now</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection
