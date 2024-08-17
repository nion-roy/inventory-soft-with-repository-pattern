<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>POS</title>

		<!-- App favicon -->
		<link rel="shortcut icon" href="{{ asset('backend') }}/assets/images/favicon.ico">

		<link href="{{ asset('backend') }}/assets/libs/morris.js/morris.css" rel="stylesheet" type="text/css" />

		<!-- Plugins css -->
		<link href="{{ asset('backend') }}/assets/libs/quill/quill.core.css" rel="stylesheet" type="text/css" />
		<link href="{{ asset('backend') }}/assets/libs/quill/quill.bubble.css" rel="stylesheet" type="text/css" />
		<link href="{{ asset('backend') }}/assets/libs/quill/quill.snow.css" rel="stylesheet" type="text/css" />

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

		<style>
			@keyframes bounceUpIn {
				0% {
					opacity: 0;
					transform: translateY(8%);
				}

				100% {
					opacity: 1;
					transform: translateY(0);
				}
			}

			.bounceUpIn {
				animation: bounceUpIn 0.5s ease forwards;
			}

			button:focus {
				box-shadow: none !important
			}

			/* Chrome, Safari, Edge, Opera */
			input::-webkit-outer-spin-button,
			input::-webkit-inner-spin-button {
				-webkit-appearance: none;
				margin: 0;
			}

			/* Firefox */
			input[type=number] {
				-moz-appearance: textfield;
			}

			.form-label,
			label {
				font-size: 15px;
				font-weight: 600;
			}

			.form-check-input[type="checkbox"] {
				border-color: rgba(32, 183, 153, .3);
			}

			.form-check-input:checked {
				background-color: rgba(32, 183, 153, 1);
				border-color: rgba(32, 183, 153, 1);
			}


			.form-control,
			.form-select {
				border: 1px solid rgba(32, 183, 153, .3);
			}

			.form-control:focus,
			.form-select:focus,
			.select2:focus {
				border: 1px solid rgba(32, 183, 153, 1);
			}


			#toast-container>div {
				opacity: 1;
			}

			.select2-container .select2-selection--single .select2-selection__rendered {
				line-height: 26px;
			}
		</style>

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
													<select name="category" id="category" class="form-select">
														<option disabled selected>-- Select Category --</option>
														@foreach ($categories as $category)
															<option value="{{ $category->id }}">{{ $category->category }}</option>
														@endforeach
													</select>
												</div>
												<div class="col-3">
													<select name="brand" id="brand" class="form-select">
														<option disabled selected>-- Select Brand --</option>
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
								<button class="btn btn-dark waves-effect waves-light disabled" type="button"><i class="bx bx-user"></i></button>
								<select name="customer_id" class="form-select select2" id="customer_id">
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
								<div class="pos-body"></div>

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
													<h4 class="grand_total">0.00</h4>
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

		<script src="{{ asset('backend') }}/assets/js/config.js"></script>

		<script src="{{ asset('backend') }}/assets/js/vendor.min.js"></script>
		<script src="{{ asset('backend') }}/assets/js/app.js"></script>

		<!-- Knob charts js -->
		<script src="{{ asset('backend') }}/assets/libs/jquery-knob/jquery.knob.min.js"></script>

		<!-- Sparkline Js-->
		<script src="{{ asset('backend') }}/assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
		<script src="{{ asset('backend') }}/assets/libs/morris.js/morris.min.js"></script>
		<script src="{{ asset('backend') }}/assets/libs/raphael/raphael.min.js"></script>

		<!-- Toastr Js -->
		<script src="{{ asset('backend') }}/assets/libs/toastr/toastr.min.js"></script>

		<!-- Dashboard init-->
		<script src="{{ asset('backend') }}/assets/js/pages/dashboard.js"></script>

		<!-- Plugins js -->
		<script src="{{ asset('backend') }}/assets/libs/quill/quill.min.js"></script>

		<!-- Demo js-->
		<script src="{{ asset('backend') }}/assets/js/pages/form-quilljs.js"></script>

		<!-- Scripts -->
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

		<script>
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		</script>


		<script src="{{ asset('backend/assets/js/pos.js') }}"></script>


		{!! Toastr::message() !!}

		@include('sweetalert::alert')

		<!-- select 2 and toastr progress js -->
		<script>
			toastr.options = {
				"progressBar": true,
				"positionClass": "toast-top-right",
				"timeOut": 1000
			}

			$('.select2').select2({
				theme: 'bootstrap-5'
			});
		</script>
		<!-- select 2 and toastr progress js -->

		<script>
			$(document).ready(function() {
				$('.order-tax').on('click', function() {
					$('#orderTax').modal('show');
				});

				$('.order-shipping').on('click', function() {
					$('#orderShipping').modal('show');
				});

				$('.order-discount').on('click', function() {
					$('#orderDiscount').modal('show');
				});

				// // Reset input values when modals are closed
				// $('#orderTax, #orderShipping, #orderDiscount').on('hidden.bs.modal', function() {
				// 	$(this).find('input[type="text"], input[type="number"]').val('');
				// 	$(this).find('select').prop('selectedIndex', 0);
				// });

				// // Disable selected option in dropdown when modal is shown
				// $('#orderTax, #orderShipping, #orderDiscount').on('shown.bs.modal', function() {
				// 	var selectedOption = $(this).find('select option:selected');
				// 	$(this).find('select option').prop('disabled', false);
				// 	selectedOption.prop('disabled', true);
				// });
			});
		</script>



	</body>

</html>
