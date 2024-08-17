<!-- Payment Modal -->
<div class="modal fade" id="addPayment" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content p-3">
			<div class="modal-header pb-2">
				<h4 class="modal-title" id="productLabel">Add Payment</h4>
				<button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body mt-2">

				<div class="row">
					<div class="mb-3 col-md-6">
						<label for="total_amount" class="form-label">Total Amount</label>
						<input type="number" class="form-control" id="total_amount" placeholder="Enter total amount" disabled>
					</div>
					<div class="mb-3 col-md-6">
						<label for="paying_amount" class="form-label">Paying Amount<span class="text-danger">*</span></label>
						<input type="number" class="form-control" name="paying_amount" id="paying_amount" placeholder="Enter paying amount">
					</div>
					<div class="mb-3 col-md-6">
						<label for="due_amount" class="form-label">Due Amount</label>
						<input type="number" class="form-control" id="due_amount" placeholder="Due amount" disabled>
					</div>
					<div class="mb-3 col-md-6">
						<label for="payment_type" class="form-label">Payment Choice<span class="text-danger">*</span></label>
						<select name="payment_type" id="payment_type" class="form-select">
							<option disabled selected> -- Selected Payment Type -- </option>
							@foreach ($payments as $payment)
								<option value="{{ $payment->id }}">{{ $payment->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="mb-3 col-md-6">
						<label for="payment_note" class="form-label">Payment Notes </label>
						<textarea name="payment_note" class="form-control" id="payment_note" cols="30" rows="3" placeholder="Enter payment notes"></textarea>
					</div>
					<div class="mb-3 col-md-6">
						<label for="sale_note" class="form-label">Sale Notes </label>
						<textarea name="sale_note" class="form-control" id="sale_note" cols="30" rows="3" placeholder="Enter sale notes"></textarea>
					</div>
				</div>
			</div>

			<div class="modal-footer border-0">
				<button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><i class="bx bx-x-circle me-1"></i>Close</button>
				<button type="submit" class="btn btn-success waves-effect" id="paymentNow"><i class="bx bx-check-double me-1"></i>Submit Now</button>
			</div>

		</div>
	</div>
</div>
<!-- Payment Modal -->
