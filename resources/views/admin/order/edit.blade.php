@extends('layouts.backend.app')

@section('title', 'Edit Brand')

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
						<li class="breadcrumb-item"><a href="{{ route('admin.brand.index') }}">Brands</a></li>
						<li class="breadcrumb-item active">Edit Brand</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<!-- end page title -->

	@include('alert-message.alert-message')

	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Edit Brand</h4>
		</div>
		<div class="card-body">
			<form action="{{ route('admin.brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<div class="row mb-3">
					<label for="brand" class="col-sm-3 col-form-label">Brand Name</label>
					<div class="col-sm-9">
						<input type="text" name="brand" class="form-control @error('brand') is-invalid @enderror" id="brand" placeholder="Enter brand name" value="{{ old('brand') ?? $brand->brand }}">
						@error('brand')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="row mb-3">
					<label for="image" class="col-sm-3 col-form-label">Brand Image</label>
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
							<input type="checkbox" name="status" class="form-check-input" id="status" {{ $brand->status == true ? 'checked' : '' }}>
							<label class="form-check-label" for="status">Active</label>
						</div>
					</div>
				</div>
				<div class="justify-content-end row">
					<div class="col-sm-9">
						<a href="{{ route('admin.brand.index') }}" class="btn btn-danger waves-effect"><i class="bx bx-left-arrow-circle me-1"></i>Back</a>
						<button type="submit" class="btn btn-success waves-effect"><i class="bx bx-upload me-1"></i>Update Now</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection
