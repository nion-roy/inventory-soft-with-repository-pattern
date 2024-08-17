<!-- Shipping Modal -->
<div class="modal fade" id="orderShipping" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content p-3">
			<div class="modal-header pb-2">
				<h4 class="modal-title" id="productLabel">Shipping Cost</h4>
				<button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			@php
				$cart = App\Models\Cart::select('shipping_type', 'shipping_charge')->first();
				$shippingType = $cart->shipping_type ?? null;
				$shippingCharge = $cart->shipping_charge ?? null;
			@endphp

			<div class="modal-body mt-2">
				<div class="row">
					<div class="mb-3 col-md-6">
						<label for="shipping_type" class="form-label">Shipping Type</label>
						<select name="shipping_type" id="shipping_type" class="form-select">
							<option selected disabled>-- Selected Shipping Type --</option>
							<option value="false">No Shipping</option>
							<option value="inside" {{ $shippingType == 'inside' ? 'selected' : '' }}>Inside Dhaka</option>
							<option value="outside" {{ $shippingType == 'outside' ? 'selected' : '' }}>Outside Dhaka</option>
						</select>
					</div>
					<div class="mb-3 col-md-6">
						<label for="shipping_price" class="form-label">Shipping Value</label>
						<input type="number" name="shipping_price" id="shipping_price" class="form-control" placeholder="Enter shipping value" value="{{ $shippingCharge }}">
					</div>
				</div>
			</div>

			<div class="modal-footer border-0">
				<button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><i class="bx bx-x-circle me-1"></i>Close</button>
				<button type="submit" class="btn btn-success waves-effect" id="shippingButton"><i class="bx bx-check-double me-1"></i>Submit Now</button>
			</div>

		</div>
	</div>
</div>
<!-- Shipping Modal -->
