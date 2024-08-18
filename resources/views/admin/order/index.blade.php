@extends('layouts.backend.app')

@section('title', 'Order')

@section('main_content')
	<!-- start page title -->
	<div class="py-3 py-lg-4">
		<div class="row">
			<div class="col-lg-6">
				<h4 class="page-title mb-0">Orders</h4>
			</div>
			<div class="col-lg-6">
				<div class="d-none d-lg-block">
					<ol class="breadcrumb m-0 float-end">
						<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
						<li class="breadcrumb-item active">Orders</li>
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
				<h4 class="card-title">Orders</h4>
			</div>
		</div>
		<div class="card-body">
			<table class="table table-striped table-hover align-middle">
				<thead>
					<th>SL</th>
					<th>Customer</th>
					<th>Total</th>
					<th>Payment</th>
					<th>Due</th>
					<th>Payment Type</th>
					<th>Order Date</th>
					<th>Received By</th>
					<th>Action</th>
				</thead>

				<tfoot>
					<th>SL</th>
					<th>Customer</th>
					<th>Total</th>
					<th>Payment</th>
					<th>Due</th>
					<th>Payment Type</th>
					<th>Order Date</th>
					<th>Received By</th>
					<th>Action</th>
				</tfoot>

				<tbody>
					@forelse ($orders as $key => $order)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $order->customer->name }}</td>
							<td>{{ $order->total_amount }}</td>
							<td>{{ $order->payment_amount }}</td>
							<td>{{ $order->due_amount }}</td>
							<td>{{ $order->payment->name ?? null }}</td>
							<td>{{ $order->created_at->format('d M, Y') }}</td>
							<td><span class="px-2 py-1 fw-bold rounded badge-soft-success">{{ $order->user->name }}</span></td>

							<td>
								<div class="btn-group mt-2 me-1">
									<button class="btn btn-success btn-sm dropdown-toggle waves-effect waves-light" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-dots-vertical"></i> </button>
									<div class="dropdown-menu">
										<a class="dropdown-item order-view" href="{{ route('admin.order.view', $order->id) }}" id="order-view"><i class="mdi mdi-eye me-1"></i>View</a>
										<button class="dropdown-item order-delete" id="order-delete" order-id="{{ $order->id }}"><i class="bx bx-trash me-1"></i>Delete</button>
										<button class="dropdown-item paymentView" order-id="{{ $order->id }}"><i class="bx bx-money me-1"></i>View Payment</button>
										<button class="dropdown-item payement-add-button" order-id="{{ $order->id }}"><i class="bx bx-plus me-1"></i>Add Payment</button>
									</div>
								</div>
							</td>



						</tr>
					@empty
						<tr>
							<td colspan="12" class="text-center">Orders records not found.!</td>
						</tr>
					@endforelse
				</tbody>


			</table>
			{{ $orders->links('layouts.backend.layouts.custome-pagination') }}
		</div>
	</div>


	@include('admin.order.delete-modal')

	@include('admin.order.payment-modal')

	@include('admin.order.payment-history')

@endsection


@push('js')
	<script src="{{ asset('backend/assets/js/order.min.js') }}"></script>
@endpush
