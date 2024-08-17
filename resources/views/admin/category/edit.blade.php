@extends('layouts.backend.app')

@section('title', 'Edit Category')

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
						<li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Categories</a></li>
						<li class="breadcrumb-item active">Edit Category</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<!-- end page title -->

	@include('alert-message.alert-message')

	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Edit Category</h4>
		</div>
		<div class="card-body">
			<form action="{{ route('admin.category.update', $category->id) }}" method="POST">
				@csrf
				@method('PUT')

				<div class="row mb-3">
					<label for="category" class="col-sm-3 col-form-label">Category Name</label>
					<div class="col-sm-9">
						<input type="text" name="category" class="form-control @error('category') is-invalid @enderror" id="category" placeholder="Enter category name" value="{{ old('category') ?? $category->category }}">
						@error('category')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>
				<div class="row justify-content-end mb-3">
					<div class="col-sm-9">
						<div class="form-check">
							<input type="checkbox" name="status" class="form-check-input" id="status" {{ $category->status == true ? 'checked' : '' }}>
							<label class="form-check-label" for="status">Active</label>
						</div>
					</div>
				</div>
				<div class="justify-content-end row">
					<div class="col-sm-9">
						<a href="{{ route('admin.category.index') }}" class="btn btn-danger waves-effect"><i class="bx bx-left-arrow-circle me-1"></i>Back</a>
						<button type="submit" class="btn btn-success waves-effect"><i class="bx bx-upload me-1"></i>Update Now</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection
