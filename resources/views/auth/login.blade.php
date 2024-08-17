<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- TITLE -->
		<title>{{ config('app.name', 'Laravel') }}</title>

		<!-- App favicon -->
		<link rel="shortcut icon" href="{{ asset('backend') }}/assets/images/favicon.ico">

		<!-- App css -->
		<link href="{{ asset('backend') }}/assets/css/style.min.css" rel="stylesheet" type="text/css">
		<link href="{{ asset('backend') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css">
		<script src="{{ asset('backend') }}/assets/js/config.js"></script>

	</head>



	<body class="bg-primary d-flex justify-content-center align-items-center min-vh-100 p-5">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-4 col-md-5">

					<div class="card">
						<div class="card-body p-4">

							<div class="text-center w-75 mx-auto auth-logo mb-4">
								<a class='logo-dark' href='{{ route('login') }}'>
									<span><img src="{{ asset('backend') }}/assets/images/logo-dark.png" alt="" height="22"></span>
								</a>

								<a class='logo-light' href='{{ route('login') }}'>
									<span><img src="{{ asset('backend') }}/assets/images/logo-light.png" alt="" height="22"></span>
								</a>
							</div>

							@include('alert-message.alert-message')


							<form action="{{ route('login') }}" method="post">
								@csrf
								<div class="row gy-3">
									<div class="col-xl-12">
										<label for="email" class="form-label text-default">Email</label>
										<input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="Enter email" value="{{ old('email') }}">
										@error('email')
											<div class="text-danger">{{ $message }}</div>
										@enderror
									</div>
									<div class="col-xl-12 mb-2">
										<label for="password" class="form-label text-default d-block">Password<a href="{{ route('password.request') }}" class="float-end text-primary">Forget password ?</a></label>
										<input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" id="password" placeholder="Enter password">
										@error('password')
											<div class="text-danger">{{ $message }}</div>
										@enderror

										<div class="mt-2">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
												<label class="form-check-label text-muted fw-normal" for="defaultCheck1"> Remember password </label>
											</div>
										</div>
									</div>
									<div class="col-xl-12 d-grid mt-2">
										<button class="btn btn-lg btn-primary">Sign In</button>
									</div>
								</div>
							</form>

						</div>
					</div>
					<!-- end card -->

				</div> <!-- end col -->
			</div>
			<!-- end row -->
		</div>

		<!-- App js -->
		<script src="{{ asset('backend') }}/assets/js/vendor.min.js"></script>
		<script src="{{ asset('backend') }}/assets/js/app.js"></script>

	</body>

</html>
