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

							<div class="text-center"> 
								<p class="text-muted">Reset Password with Symox.</p>
							</div>
              
							<div class="p-2 mt-4">
								
								<form method="POST" action="{{ route('password.email') }}">
									@csrf
									<div class="mb-4">
										<label for="emailaddress" class="form-label">Email address</label>
										<input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="emailaddress" value="{{ old('email') }}" placeholder="Enter your email">
										@error('email')
											<div class="text-danger">{{ $message }}</div>
										@enderror
									</div>

									<div class="mt-3 text-end">
										<button class="btn btn-primary waves-effect w-100" type="submit">Reset</button>
									</div>

									<div class="mt-4 text-center">
										<p class="mb-0">Remember It ? <a href="{{ route('login') }}" class="fw-medium text-primary"> Sign in </a></p>
									</div>
								</form>
							</div>

						</div>
					</div>
				</div> <!-- end col -->
			</div>
			<!-- end row -->
		</div>

		<!-- App js -->
		<script src="{{ asset('backend') }}/assets/js/vendor.min.js"></script>
		<script src="{{ asset('backend') }}/assets/js/app.js"></script>

	</body>

</html>
