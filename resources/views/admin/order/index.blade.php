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
	<script>
		$(document).ready(function() {
			$(".paymentView").click(function(e) {
				e.preventDefault();
				var orderId = $(this).attr('order-id');
				var url = "/admin/payment-history/" + orderId;

				$('#paymentHistory').modal('show');
				getPaymentHistory(url);
			});

			//Payment history delete with ajax
			$('#paymentHistory').on('click', '.paymentHistoryDelete', function(e) {
				e.preventDefault();
				var deleteId = $(this).attr('delete-id');
				var customerId = $(this).attr('customer-id');
				var deleteUrl = "/admin/payment-history-delete/" + deleteId;

				$.ajax({
					type: "GET",
					url: deleteUrl,
					success: function(response) {
						var url = "/admin/payment-history/" + customerId;
						getPaymentHistory(url);
						// alert(url);
						toastr.success("Payment item delete successfull", "Success");
					}
				});
			});
			//Payment history delete with ajax

			//Get Payment history function with ajax
			function getPaymentHistory(url) {
				$.ajax({
					url: url,
					type: "GET",
					success: function(response) {
						$('#paymentHistory tbody').empty();

						if (response.length === 0) {
							$('#paymentHistory tbody').html('<tr><td colspan="7" class="text-center">No payment history found</td></tr>');
						} else {
							$.each(response, function(key, payment) {
								var row = '<tr>' +
									'<td>' + (key + 1) + '</td>' +
									'<td>' + formatDate(payment.created_at) + '</td>' +
									'<td>' + formatCurrency(payment.total_amount) + '</td>' +
									'<td>' + formatCurrency(payment.payment_amount) + '</td>' +
									'<td>' + formatCurrency(payment.due_amount) + '</td>' +
									'<td> <span class="px-2 py-1 fw-bold rounded badge-soft-success">' + payment.user.name + '</span></td>' +
									'<td> <button type="button" class="btn btn-danger btn-sm waves-effect waves-light paymentHistoryDelete" id="paymentHistoryDelete" delete-id=' + payment.id + ' customer-id=' + payment.customer_id + '><i class="bx bx-trash"></i></button></td>' +
									'</tr>';
								$('#paymentHistory tbody').append(row);
							});
						}

					}
				});
			}
			//Get Payment history function with ajax

			function formatCurrency(amount) {
				return parseFloat(amount).toFixed(2);
			}

			function formatDate(dateString) {
				var date = new Date(dateString);
				var day = date.getDate();
				var month = date.toLocaleString('default', {
					month: 'short'
				});
				var year = date.getFullYear();
				return day + '-' + month + '-' + year;
			}

			var successMessage = localStorage.getItem("successMessage");
			if (successMessage) {
				toastr.options = {
					"progressBar": true,
					"positionClass": "toast-top-right",
					"timeOut": 1000
				}
				toastr.success(successMessage, "Success");
				localStorage.removeItem("successMessage");
			}
		});
	</script>
@endpush

@push('js')
	<script>
		$('.order-delete').on('click', function() {
			$('#orderDeleteModal').modal('show');
			var orderID = $(this).attr('order-id');
			var url = "/admin/order/destroy/" + orderID;
			// alert(orderID);
			$('#orderDeleteForm').attr('action', url); // Set the form action
		});
	</script>
@endpush

@push('js')
	<script>
		//Get to payment history with order id on ajax
		$('.payement-add-button').click(function(e) {
			e.preventDefault();
			$('#addPayment').modal('show');

			var orderId = $(this).attr('order-id');
			$url = "/admin/payment-history/" + orderId;

			$.ajax({
				url: $url,
				type: "GET",
				success: function(response) {
					// console.log(response);
					var latestPayment = response[0];
					$('#total_amount').val(latestPayment.due_amount);
					$('#paymentNow').attr('order-id', latestPayment.order_id);
				},
			});
		});
		//Get to payment history with order id on ajax


		// Function to calculation
		$("#paying_amount").on("input", function() {
			var totalAmount = parseFloat($("#total_amount").val());
			var payingAmount = parseFloat($("#paying_amount").val());
			var dueAmount = totalAmount - payingAmount;
			if (payingAmount) {
				$("#due_amount").val(dueAmount);
			} else {
				$("#due_amount").val(totalAmount);
			}
		});
		// Function to calculation
	</script>
@endpush

@push('js')
	<script>
		// New payment added to user in order
		$("#paymentNow").click(function(e) {
			e.preventDefault();

			var orderID = $(this).attr('order-id');
			var url = "/admin/payment-add/" + orderID;
			// alert(orderID);

			// Clear previous error messages
			$(".is-invalid").removeClass("is-invalid");
			$(".invalid-feedback").remove();

			var formData = {
				customer_id: $("#customer_id").val(),
				order_id: $("#order_id").val(),
				total_amount: $("#total_amount").val(),
				paying_amount: $("#paying_amount").val(),
				due_amount: $("#due_amount").val(),
				payment_type: $("#payment_type").val(),
				payment_note: $("#payment_note").val(),
				sale_note: $("#sale_note").val(),
			};

			$.ajax({
				url: url,
				type: "POST",
				data: formData,
				success: function(response) {
					// alert(response);
					localStorage.setItem("successMessage", "New payment added successfully.");
					window.location.href = window.location.href;
				},
				error: function(xhr, status, error) {
					var errors = xhr.responseJSON;
					$.each(errors.errors, function(key, value) {
						$("#" + key).addClass("is-invalid");
						$("#" + key).after('<span class="invalid-feedback text-danger">' + value[0] + "</span>");
					});
				},
			});
		});
		// New payment added to user in order
	</script>
@endpush
