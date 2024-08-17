@extends('layouts.backend.app')

@section('title', 'Payment')

@section('main_content')
	<!-- start page title -->
	<div class="py-3 py-lg-4">
		<div class="row">
			<div class="col-lg-6">
				<h4 class="page-title mb-0">Payments</h4>
			</div>
			<div class="col-lg-6">
				<div class="d-none d-lg-block">
					<ol class="breadcrumb m-0 float-end">
						<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
						<li class="breadcrumb-item active">Payments</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<!-- end page title -->

	@include('alert-message.alert-message')

	<div class="card">
		<div class="card-header">
			<div class="d-flex align-items-center justify-content-between">
				<h4 class="card-title">Payments</h4>
				<a href="{{ route('admin.payment-method.create') }}" class="btn btn-success waves-effect"><i class="bx bxs-add-to-queue me-1"></i>Add Payment</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table table-striped table-hover align-middle">
				<thead>
					<th>SL</th>
					<th>Payment</th>
					<th>Image</th>
					<th>Status</th>
					<th>Creation</th>
					<th>Action</th>
				</thead>

				<tfoot>
					<th>SL</th>
					<th>Payment</th>
					<th>Image</th>
					<th>Status</th>
					<th>Creation</th>
					<th>Action</th>
				</tfoot>

				<tbody>
					@forelse ($payments as $key => $payment)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $payment->name }}</td>
							<td>
								@if ($payment->image == 'payment.png')
									<img src="{{ asset('default/payment.png') }}" class="img-fluid img-thumbnail" width="40px" alt="{{ $payment->payment }}">
								@else
									<img src="{{ asset($payment->image) }}" class="img-fluid img-thumbnail" width="40px" alt="{{ $payment->payment }}">
								@endif
							</td>
							<td>
								@if ($payment->status == true)
									<span class="px-2 py-1 fw-bold rounded badge-soft-success">Active</span>
								@else
									<span class="px-2 py-1 fw-bold rounded badge-soft-danger">Inactive</span>
								@endif
							</td>
							<td><span class="px-2 py-1 fw-bold rounded badge-soft-danger">{{ $payment->user->name }}</span></td>
							<td>
								<div class="d-flex align-items-center gap-1">
									<a href="{{ route('admin.payment-method.edit', $payment->id) }}" class="btn btn-success waves-effect"><i class="bx bx-edit-alt me-1"></i>Edit</a>
									<button class="btn btn-danger waves-effect payment-delete" payment-id="{{ $payment->id }}" payment-name="{{ $payment->name }}"><i class="bx bx-trash me-1"></i>Delete</button>
								</div>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="12" class="text-center">Payments records not found.!</td>
						</tr>
					@endforelse
				</tbody>

			</table>
			{{ $payments->links('layouts.backend.layouts.custome-pagination') }}
		</div>
	</div>

	<!-- Delete Modal -->
	<div class="modal fade bounceUpIn" id="paymentDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content p-3">
				<div class="modal-header">
					<h4 class="modal-title" id="paymentLabel">Delete Payment</h4>
					<button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					This will delete <strong></strong>
				</div>
				<div class="modal-footer border-0">
					<button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><i class="bx bx-x-circle me-1"></i>Close</button>
					<form id="paymentDeleteForm" method="post">
						@csrf
						@method('DELETE')
						<button class="btn btn-danger waves-effect"><i class="bx bx-trash me-1"></i>Delete</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Delete Modal -->


@endsection


@push('js')
	<script>
		$('.payment-delete').on('click', function() {
			$('#paymentDeleteModal').modal('show');
			var paymentID = $(this).attr('payment-id');
			var paymentName = $(this).attr('payment-name');
			var url = "/admin/payment-method/" + paymentID;

			// alert(paymentName);
			$('.modal-body strong').text(paymentName);
			$('#paymentDeleteForm').attr('action', url); // Set the form action
		});
	</script>
@endpush
