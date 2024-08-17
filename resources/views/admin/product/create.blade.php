@extends('layouts.backend.app')

@section('title', 'Add Product')

@section('main_content')
	<!-- start page title -->
	<div class="py-3 py-lg-4">
		<div class="row">
			<div class="col-lg-6">
				<h4 class="page-title mb-0">Products</h4>
			</div>
			<div class="col-lg-6">
				<div class="d-none d-lg-block">
					<ol class="breadcrumb m-0 float-end">
						<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Products</a></li>
						<li class="breadcrumb-item active">Create Product</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<!-- end page title -->

	@include('alert-message.alert-message')

	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Add Product</h4>
		</div>
		<div class="card-body">
			<form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="row">
					<div class="col-lg-6">
						<div class="mb-3">
							<label for="category_id" class="form-label">Category</label>
							<select name="category_id" class="form-select @error('category_id') is-invalid @enderror" id="category_id">
								<option disabled selected> -- Selected Category -- </option>
								@foreach ($categories as $category)
									<option value="{{ $category->id }}">{{ $category->category }}</option>
								@endforeach
							</select>
							@error('category_id')
								<div class="text-danger">{{ $message }}</div>
							@enderror
						</div>
						<div class="mb-3">
							<label for="product_name" class="form-label">Product Name</label>
							<input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" id="product_name" placeholder="Enter product name" value="{{ old('product_name') }}">
							@error('product_name')
								<div class="text-danger">{{ $message }}</div>
							@enderror
						</div>
						<div class="mb-3">
							<label for="image" class="form-label">Product Image</label>
							<input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
							@error('image')
								<div class="text-danger">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="col-lg-6">
						<div class="mb-3">
							<label for="quantity" class="form-label">Quantity</label>
							<input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" id="quantity" placeholder="Enter product quantity">
							@error('quantity')
								<div class="text-danger">{{ $message }}</div>
							@enderror
						</div>
						<div class="mb-3">
							<label for="buying_price" class="form-label">Buying Price</label>
							<input type="number" name="buying_price" class="form-control @error('buying_price') is-invalid @enderror" id="buying_price" placeholder="Enter product buying price">
							@error('buying_price')
								<div class="text-danger">{{ $message }}</div>
							@enderror
						</div>
						<div class="mb-3">
							<label for="selling_price" class="form-label">Selling Price</label>
							<input type="number" name="selling_price" class="form-control @error('selling_price') is-invalid @enderror" id="selling_price" placeholder="Enter product selling price">
							@error('selling_price')
								<div class="text-danger">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="col-12">
						<div class="mb-3">
							<label for="product_details" class="form-label">Product Description</label>
							<textarea name="product_details" id="snow-editor" placeholder="Type your text here..."></textarea>
						</div>

						<div class="mb-3 form-check">
							<input type="checkbox" name="status" class="form-check-input" id="status">
							<label class="form-check-label" for="status">Active</label>
						</div>
						<a href="{{ route('admin.product.index') }}" class="btn btn-danger waves-effect"><i class="bx bx-left-arrow-circle me-1"></i>Back</a>
						<button type="submit" class="btn btn-success waves-effect"><i class="bx bx-plus-circle me-1"></i>Add Now</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection
