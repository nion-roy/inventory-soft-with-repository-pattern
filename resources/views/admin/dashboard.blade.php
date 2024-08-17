@extends('layouts.backend.app')

@section('title', 'Dashbaord')

@section('main_content')
	<!-- start page title -->
	<div class="py-3 py-lg-4">
		<div class="row">
			<div class="col-lg-6">
				<h4 class="page-title mb-0">Dashboard</h4>
			</div>
			<div class="col-lg-6">
				<div class="d-none d-lg-block">
					<ol class="breadcrumb m-0 float-end">
						<li class="breadcrumb-item active">Dashboard</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<!-- end page title -->

	<div class="row">

		<div class="col-md-6 col-xl-3">
			<div class="card">
				<div class="card-body">
					<div class="d-flex align-items-center justify-content-between">
						<div class="menu-content">
							<h5 class="card-title mb-3">Total Sale Amount</h5>
							<h2 class="d-flex align-items-center mb-0"> ${{ number_format($saleAmount, 2) }} </h2>
						</div>
						<div class="menu-icon">
							<span class="btn btn-dark fs-4"><i class="bx bx-money"></i></span>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="col-md-6 col-xl-3">
			<div class="card">
				<div class="card-body">
					<div class="d-flex align-items-center justify-content-between">
						<div class="menu-content">
							<h5 class="card-title mb-3">Total Sales Due</h5>
							<h2 class="d-flex align-items-center mb-0"> ${{ number_format($saleDue, 2) }} </h2>
						</div>
						<div class="menu-icon">
							<span class="btn btn-dark fs-4"><i class="bx bx-down-arrow-alt"></i></span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-12"></div>

		<div class="col-md-6 col-xl-3">
			<div class="card">
				<div class="card-body bg-success text-white">
					<div class="d-flex align-items-center justify-content-between">
						<div class="menu-content">
							<h5 class="card-title mb-3">Customers</h5>
							<h2 class="d-flex align-items-center mb-0 text-white"> {{ $customer }} </h2>
						</div>
						<div class="menu-icon">
							<span class="btn btn-dark fs-4"><i class="bx bx-user"></i></span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-xl-3">
			<div class="card">
				<div class="card-body bg-danger text-white">
					<div class="d-flex align-items-center justify-content-between">
						<div class="menu-content">
							<h5 class="card-title mb-3">Sales Invoice</h5>
							<h2 class="d-flex align-items-center mb-0 text-white"> {{ $saleInvoice }} </h2>
						</div>
						<div class="menu-icon">
							<span class="btn btn-dark fs-4"><i class="bx bx-copy-alt"></i></span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-xl-3">
			<div class="card">
				<div class="card-body bg-primary text-white">
					<div class="d-flex align-items-center justify-content-between">
						<div class="menu-content">
							<h5 class="card-title mb-3">Payment Methoad</h5>
							<h2 class="d-flex align-items-center mb-0 text-white"> {{ $paymentMethoad }} </h2>
						</div>
						<div class="menu-icon">
							<span class="btn btn-dark fs-4"><i class="bx bxl-paypal"></i></span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-xl-3">
			<div class="card">
				<div class="card-body bg-warning text-white">
					<div class="d-flex align-items-center justify-content-between">
						<div class="menu-content">
							<h5 class="card-title mb-3">Products</h5>
							<h2 class="d-flex align-items-center mb-0 text-white"> {{ $product }} </h2>
						</div>
						<div class="menu-icon">
							<span class="btn btn-dark fs-4"><i class="bx bx-purchase-tag"></i></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



	<div class="row">
		<div class="col-12 col-md-6">
			<div class="card">
				<div class="card-header d-flex align-items-center justify-content-between">
					<h4 class="header-title m-0">Recent Customers</h4>
					<a href="{{ route('admin.customer.index') }}">All Customers</a>
				</div>
				<div class="card-body">
					<table class="table table-striped align-middle">
						<thead>
							<tr>
								<th>SL</th>
								<th>Customer</th>
								<th>Phone</th>
								<th>Address</th>
							</tr>
						</thead>
						<tbody>

							@foreach ($customers as $key => $customer)
								<tr>
									<td>{{ $key + 1 }}</td>
									<td>{{ $customer->name }}</td>
									<td>{{ $customer->contact }}</td>
									<td>{{ $customer->address }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col-12 col-md-6">
			<div class="card">
				<div class="card-header d-flex align-items-center justify-content-between">
					<h4 class="header-title m-0">Recent Products</h4>
					<a href="{{ route('admin.product.index') }}">All Products</a>
				</div>
				<div class="card-body">
					<table class="table table-striped align-middle">
						<thead>
							<tr>
								<th>SL</th>
								<th>Products</th>
								<th>Price</th>
							</tr>
						</thead>
						<tbody>

							@foreach ($products as $key => $product)
								<tr>
									<td>{{ $key + 1 }}</td>
									<td><img src="{{ asset($product->image) }}" class="img-fluid rounded me-2" style="width: 40px; height:40px" alt="{{ $product->product_name }}">{{ $product->product_name }}</td>
									<td>${{ number_format($product->selling_price, 2) }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
