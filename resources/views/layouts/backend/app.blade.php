<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>@yield('title') | POS</title>

		<!-- App favicon -->
		<link rel="shortcut icon" href="{{ asset('backend') }}/assets/images/favicon.ico">

		<link href="{{ asset('backend') }}/assets/libs/morris.js/morris.css" rel="stylesheet" type="text/css" />

		<!-- Plugins css -->
		<link href="{{ asset('backend') }}/assets/libs/quill/quill.core.css" rel="stylesheet" type="text/css" />
		<link href="{{ asset('backend') }}/assets/libs/quill/quill.bubble.css" rel="stylesheet" type="text/css" />
		<link href="{{ asset('backend') }}/assets/libs/quill/quill.snow.css" rel="stylesheet" type="text/css" />

		<!-- App css -->
		<link href="{{ asset('backend') }}/assets/css/style.min.css" rel="stylesheet" type="text/css" />
		<link href="{{ asset('backend') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

		<!-- Toastr css -->
		<link href="{{ asset('backend') }}/assets/libs/toastr/toastr.min.css" rel="stylesheet" type="text/css" />

		@stack('css')


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
		</style>
	</head>

	<body>

		<!-- Begin page -->
		<div class="layout-wrapper">

			<!-- ========== Left Sidebar ========== -->
			@include('layouts.backend.layouts.sidebar')


			<!-- ============================================================== -->
			<!-- Start Page Content here -->
			<!-- ============================================================== -->

			<div class="page-content">

				<!-- ========== Topbar Start ========== -->
				@include('layouts.backend.layouts.header')
				<!-- ========== Topbar End ========== -->

				<div class="px-3">

					<!-- Start Content-->
					<div class="container-fluid">

						@yield('main_content')

					</div> <!-- container -->

				</div> <!-- content -->

				<!-- Footer Start -->
				@include('layouts.backend.layouts.footer')
				<!-- end Footer -->

			</div>

			<!-- ============================================================== -->
			<!-- End Page content -->
			<!-- ============================================================== -->

		</div>
		<!-- END wrapper -->

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

		<script>
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		</script>

		{!! Toastr::message() !!}

		@include('sweetalert::alert')

		@stack('js')


		<script>
			toastr.options = {
				"progressBar": true,
				"positionClass": "toast-top-right",
				"timeOut": 1000
			}
		</script>

	</body>

</html>
