@extends('layouts.backend.app')

@section('title', 'Add Customer')

@section('main_content')
	<!-- start page title -->
	<div class="py-3 py-lg-4">
		<div class="row">
			<div class="col-lg-6">
				<h4 class="page-title mb-0">SMTP Configration</h4>
			</div>
			<div class="col-lg-6">
				<div class="d-none d-lg-block">
					<ol class="breadcrumb m-0 float-end">
						<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
						<li class="breadcrumb-item active">SMTP Configration</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<!-- end page title -->

	@include('alert-message.alert-message')

	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Update Email SMTP Configration</h4>
		</div>
		<div class="card-body">
			<form action="{{ route('admin.email.update', $email->id) }}" method="POST">
				@csrf
				<div class="row mb-3">
					<label for="mail_host" class="col-sm-3 col-form-label">Mail Host</label>
					<div class="col-sm-9">
						<input type="text" name="mail_host" class="form-control @error('mail_host') is-invalid @enderror" id="mail_host" placeholder="Enter mail host" value="{{ $email->mail_host }}">
						@error('mail_host')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div class="row mb-3">
					<label for="mail_port" class="col-sm-3 col-form-label">Mail Port</label>
					<div class="col-sm-9">
						<input type="text" name="mail_port" class="form-control @error('mail_port') is-invalid @enderror" id="mail_port" placeholder="Enter mail host" value="{{ $email->mail_port }}">
						@error('mail_port')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div class="row mb-3">
					<label for="mail_username" class="col-sm-3 col-form-label">Mail Username</label>
					<div class="col-sm-9">
						<input type="text" name="mail_username" class="form-control @error('mail_username') is-invalid @enderror" id="mail_username" placeholder="Enter mail username" value="{{ $email->mail_username }}">
						@error('mail_username')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div class="row mb-3">
					<label for="mail_password" class="col-sm-3 col-form-label">Mail Password</label>
					<div class="col-sm-9">
						<input type="text" name="mail_password" class="form-control @error('mail_password') is-invalid @enderror" id="mail_password" placeholder="Enter mail password" value="{{ $email->mail_password }}">
						@error('mail_password')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div class="row mb-3">
					<label for="mail_encryption" class="col-sm-3 col-form-label">Mail Encryption</label>
					<div class="col-sm-9">
						<input type="text" name="mail_encryption" class="form-control @error('mail_encryption') is-invalid @enderror" id="mail_encryption" placeholder="Enter mail encryption" value="{{ $email->mail_encryption }}">
						@error('mail_encryption')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>

				<div class="row mb-3">
					<label for="mail_from_name" class="col-sm-3 col-form-label">Mail From Name</label>
					<div class="col-sm-9">
						<input type="text" name="mail_from_name" class="form-control @error('mail_from_name') is-invalid @enderror" id="mail_from_name" placeholder="Enter mail from name" value="{{ $email->mail_from_name }}">
						@error('mail_from_name')
							<div class="text-danger">{{ $message }}</div>
						@enderror
					</div>
				</div>


				<div class="justify-content-end row">
					<div class="col-sm-9">
						<button type="submit" class="btn btn-success waves-effect"><i class="bx bx-upload me-1"></i>Update Now</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection
