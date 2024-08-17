@extends('layouts.backend.app')

@section('title', 'Invoice')

@section('main_content')
	<div class="py-3 py-lg-4">
		<div class="row">
			<div class="col-lg-6">
				<h4 class="page-title mb-0">Invoice</h4>
			</div>
			<div class="col-lg-6">
				<div class="d-none d-lg-block">
					<ol class="breadcrumb m-0 float-end">
						<li class="breadcrumb-item"><a href="javascript: void(0);">Extra Pages</a></li>
						<li class="breadcrumb-item active">Invoice</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<!-- end page title -->

	<div class="row my-3">
		<div class="col-12">
			<!-- Logo & title -->
			<div class="clearfix">
				<div class="float-start">
					<img src="assets/images/logo-dark.png" alt="" height="20" />
				</div>
				<div class="float-end">
					<h4 class="m-0 d-print-none">Invoice</h4>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="mt-3">
						<h5 class="mb-2">Hello, {{ $order->customer->name }}</h5>
						<p class="text-muted">Thanks a lot because you keep purchasing our products. Our company promises to provide high quality products for you as well as outstanding customer service for every transaction.</p>
					</div>
				</div>
				<!-- end col -->
				<div class="col-md-6">
					<div class="mt-3 float-end">
						<p class="mb-2"><span class="font-weight-medium">Order Date : </span> <span class="float-end"> &nbsp;&nbsp;&nbsp;&nbsp; {{ $order->created_at->format('F d, Y') }}</span></p>
						<p class="mb-2">
							<span class="font-weight-medium">Order Status : </span> <span class="float-end">
								@if ($order->due_amount > 0)
									<span class="badge bg-danger">Due</span>
								@elseif ($order->total_amount == $order->due_amount)
								@else
									<span class="badge bg-success">Paid</span>
								@endif
							</span>
						</p>
						<p class="mb-2"><span class="font-weight-medium">Order No. : </span> <span class="float-end">{{ $order->order_number }} </span></p>
						<p><span class="font-weight-medium">Payment Type. : </span> <span class="float-end">{{ $order->payment->name }} </span></p>
					</div>
				</div>
				<!-- end col -->
			</div>
			<!-- end row -->

			<div class="row mt-3">
				<div class="col-md-6">
					<h6>Billing Address</h6>
					<address>
						Stanley Jones<br />
						795 Folsom Ave, Suite 600<br />
						San Francisco, CA 94107<br />
						<abbr title="Phone">P:</abbr> (123) 456-7890
					</address>
				</div>
				<!-- end col -->

				<div class="col-md-6">
					<div class="text-md-end">
						<h6>Shipping Address</h6>
						<address>
							Stanley Jones<br />
							795 Folsom Ave, Suite 600<br />
							San Francisco, CA 94107<br />
							<abbr title="Phone">P:</abbr> (123) 456-7890
						</address>
					</div>
				</div>
				<!-- end col -->
			</div>
			<!-- end row -->

			<div class="row">
				<div class="col-12">
					<div class="table-responsive">
						<table class="table mt-4 table-centered">
							<thead class="">
								<tr>
									<th>#</th>
									<th>Product</th>
									<th style="width: 10%">Price</th>
									<th style="width: 10%">Quantity</th>
									<th style="width: 10%" class="text-end">Sub Total</th>
								</tr>
							</thead>
							<tbody>

								@php
									$total = 0;
									$taxCalculation = 0;
									$discount = 0;
									$delivery = 0;
								@endphp

								@foreach ($order->orderDetails as $key => $details)
									<tr>
										<td>{{ str_pad($key + 1, 2, '0', STR_PAD_LEFT) }}</td>
										<td>
											<div class="d-flex align-items-center gap-2">
												<img src="{{ asset($details->product->image) }}" class="img-fluid img-thumbnail shadow-none" width="50px" alt="{{ $details->product->product_name }}">
												<h5 class="m-0">{{ $details->product->product_name }}</h5>
											</div>
										</td>
										<td>
											<p class="text-muted mb-0">${{ number_format($details->product->selling_price, 2) }}</p>
										</td>
										<td>{{ $details->quantity }}</td>
										<td class="text-end">${{ number_format($details->quantity * $details->price, 2) }}</td>
									</tr>

									@php
										$tax = round(calculatePriceFromTax($details->price, $details->tax));
										$taxCalculation += $details->tax * $details->quantity;
										$delivery = $details->shipping_charge;
										$discount = $details->discount_price;
										$total += $details->quantity * $details->price;
									@endphp
								@endforeach



							</tbody>
						</table>
					</div>
					<!-- end table-responsive -->
				</div>
				<!-- end col -->
			</div>
			<!-- end row -->

			<div class="row">
				<div class="col-sm-6">
					<div class="clearfix pt-5">
						<h6 class="text-muted">Notes:</h6>

						<small class="text-muted"> All accounts are to be paid within 7 days from receipt of invoice. To be paid by cheque or credit card or direct payment online. If account is not paid within 7 days the credits details supplied as confirmation of work undertaken will be charged the agreed quoted fee noted above. </small>
					</div>
				</div>
				<!-- end col -->
				<div class="col-sm-6">
					<div class="float-end">
						<p><span class="font-weight-medium">Sub-total:</span> <span class="float-end">${{ number_format($total, 2) }}</span></p>
						<p><span class="font-weight-medium">Tax ({{ $tax }}%):</span> <span class="float-end"> &nbsp;&nbsp;&nbsp; ${{ number_format($taxCalculation, 2) }}</span></p>
						<p><span class="font-weight-medium">Shipping Charge:</span> <span class="float-end"> &nbsp;&nbsp;&nbsp; ${{ number_format($delivery, 2) }}</span></p>
						<p><span class="font-weight-medium">Discount:</span> <span class="float-end"> &nbsp;&nbsp;&nbsp; ${{ number_format($discount, 2) }}</span></p>
						<h3>${{ number_format($total + $taxCalculation + $delivery - $discount, 2) }} USD</h3>
					</div>
					<div class="clearfix"></div>
				</div>
				<!-- end col -->
			</div>
			<!-- end row -->

			<div class="mt-4 mb-1">
				<div class="text-end d-print-none">
					<a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-printer me-1"></i> Print</a>
				</div>
			</div>
		</div>
		<!-- end col -->
	</div>

@endsection
