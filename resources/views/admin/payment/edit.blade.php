@extends('layouts.backend.app')

@section('title', 'Edit Payment')

@section('main_content')
	<!-- start page title -->
	<div class="py-3 py-lg-4">
		<div class="row">
			<div class="col-lg-6">
				<h4 class="page-title mb-0">Payments</h4>
			</div>
			<div class="col-lg-6">
				<div class="d-none d-lg-block">
					<ol class="breadcrumb m-0 float-end">
						<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="{{ route('admin.payment-method.index') }}">Payments</a></li>
						<li class="breadcrumb-item active">Edit Payment</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<!-- end page title -->

	@include('alert-message.alert-message')

	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Edit Payment</h4>
		</div>
		<div class="card-body">
			<form action="{{ route('admin.payment-method.update', $payment->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<div class="row mb-3">
					<label for="name" class="col-sm-3 col-form-label">Payment Name</label>
					<div class="col-sm-9">
						<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter payment name" value="{{ old('name') ?? $payment->name }}">
						@error('name')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="row mb-3">
					<label for="image" class="col-sm-3 col-form-label">Payment Image</label>
					<div class="col-sm-9">
						<input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
						@error('image')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="row justify-content-end mb-3">
					<div class="col-sm-9">
						<div class="form-check">
							<input type="checkbox" name="status" class="form-check-input" id="status" {{ $payment->status == true ? 'checked' : '' }}>
							<label class="form-check-label" for="status">Active</label>
						</div>
					</div>
				</div>
				<div class="justify-content-end row">
					<div class="col-sm-9">
						<a href="{{ route('admin.payment-method.index') }}" class="btn btn-danger waves-effect"><i class="bx bx-left-arrow-circle me-1"></i>Back</a>
						<button type="submit" class="btn btn-success waves-effect"><i class="bx bx-upload me-1"></i>Update Now</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection
