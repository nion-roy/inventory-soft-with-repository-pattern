<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>POS</title>

		<!-- App favicon -->
		<link rel="shortcut icon" href="{{ asset('backend') }}/assets/images/favicon.ico">

		<!-- Styles -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

		<!-- App css -->
		<link href="{{ asset('backend') }}/assets/css/style.min.css" rel="stylesheet" type="text/css" />
		<link href="{{ asset('backend') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

		<!-- Toastr css -->
		<link href="{{ asset('backend') }}/assets/libs/toastr/toastr.min.css" rel="stylesheet" type="text/css" />

		<link rel="stylesheet" href="{{ asset('backend/assets/css/pos.min.css') }}">

		

	</head>

	<body>

		<div class="container-fluid">

			<!-- start page title -->
			<div class="py-3 py-lg-4">
				<div class="row">
					<div class="col-lg-6">
						<h4 class="page-title mb-0">Point of Sale</h4>
					</div>
					<div class="col-lg-6">
						<div class="d-none d-lg-block">
							<ol class="breadcrumb m-0 float-end">
								<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<!-- end page title -->

			<div class="row">
				<div class="col-lg-8">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-12">
									<div class="row">
										<div class="col-lg-12 mb-3">

											<div class="row">
												<div class="col-6">
													<input type="text" name="search" class="form-control" id="search" placeholder="Search...">
												</div>
												<div class="col-3">
													<select name="category" id="category" class="form-select" >
														<option value="">-- Selected Category --</option>
														@foreach ($categories as $category)
															<option value="{{ $category->id }}">{{ $category->category }}</option>
														@endforeach
													</select>
												</div>
												<div class="col-3">
													<select name="brand" id="brand" class="form-select">
														<option value="">-- Selected Brand --</option>
														@foreach ($brands as $brand)
															<option value="{{ $brand->id }}">{{ $brand->brand }}</option>
														@endforeach
													</select>
												</div>
											</div>


										</div>
									</div>
								</div>

								<hr>

								<div class="col-12">
									<div class="row" id="product__lists">
										@include('admin.pos.render_product')
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>


				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="customer">
								<select name="customer" class="form-select" id="customer">
									<option disabled selected>-- Select Customer --</option>
									@foreach ($customers as $customer)
										<option value="{{ $customer->id }}">{{ $customer->name }}</option>
									@endforeach
								</select>
								<button class="btn btn-dark waves-effect waves-light ms-2 rounded" type="button" data-bs-toggle="modal" data-bs-target="#addNewCustomer"><i class="bx bx-user-plus"></i></button>
							</div>

							<div class="pos">
								<div class="pos-header py-3">
									<h4>Cart</h4>
								</div>

								<div class="pos-body">@include('admin.pos.render_cart')</div>

								<hr>

								<div class="pos-option pb-3">
									<div class="row align-items-center">
										<div class="col-sm-4">
											<span class="totals-title me-2">Items :</span><span id="quantity">(0)</span>
										</div>
										<div class="col-sm-4">
											<span class="totals-title me-2">Total :</span><span id="subtotal">0.00</span>
										</div>
										<div class="col-sm-4">
											<span class="totals-title">Discount : <button type="button" class="btn btn-link btn-sm order-discount"><i class="bx bxs-edit fs-5"></i></button></span><span id="discount">0.00</span>
										</div>
										<div class="col-sm-4">
											<span class="totals-title">Tax : <button type="button" class="btn btn-link btn-sm order-tax"><i class="bx bxs-edit fs-5"></i></button></span><span id="tax">0.00</span>
										</div>
										<div class="col-sm-4">
											<span class="totals-title">Shipping : <button type="button" class="btn btn-link btn-sm order-shipping"><i class="bx bxs-edit fs-5"></i></button></span><span id="shipping-cost">0.00</span>
										</div>
									</div>
								</div>

								<div class="pos-footer">
									<div class="card">
										<div class="card-body bg-light">
											<div class="row">
												<div class="col-9">
													<h4>Grand Total</h4>
												</div>
												<div class="col-3">
													<h4 class="grand__total">0.00</h4>
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 text-end mt-3">
										<div class="d-flex align-items-center gap-2">
											<button type="button" class="btn btn-danger waves-effect w-25 fs-5" id="reset"><i class="bx bx-refresh me-1"></i>Reset</button>
											<button type="button" class="btn btn-success waves-effect w-75 fs-5" id="orderNow" data-bs-toggle="modal" data-bs-target="#orderPyament" disabled>Selected Customer</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>



				</div>

				@include('admin.pos.modal.customer')

				@include('admin.pos.modal.payment')

				@include('admin.pos.modal.tax')

				@include('admin.pos.modal.discount')

				@include('admin.pos.modal.shipping')


			</div>

		</div>
		<!-- App js -->
		<script src="{{ asset('backend') }}/assets/js/vendor.min.js"></script>
		<script src="{{ asset('backend') }}/assets/js/app.js"></script>

		<!-- Toastr Js -->
		<script src="{{ asset('backend') }}/assets/libs/toastr/toastr.min.js"></script>

		<!-- Scripts -->
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

		<script src="{{ asset('backend/assets/js/pos.js') }}"></script>

		{!! Toastr::message() !!}

		@include('sweetalert::alert')
	</body>

</html>
