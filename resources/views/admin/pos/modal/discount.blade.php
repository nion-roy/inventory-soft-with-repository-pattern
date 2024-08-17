<!-- Discount Modal -->
<div class="modal fade" id="orderDiscount" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content p-3">
			<div class="modal-header pb-2">
				<h4 class="modal-title" id="productLabel">Order Discount</h4>
				<button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			@php
				$carts = App\Models\Cart::where('user_id', Auth::id())->select('price', 'discount_type', 'discount_price')->get();
				$totalPrice = $carts->sum('price');
				$discountType = $carts->first()->discount_type ?? null;
				$discountPrice = $carts->first()->discount_price ?? null;
				$percentage = productToDiscount($totalPrice, $discountPrice);
			@endphp

			<div class="modal-body mt-2">

				<div class="row">
					<div class="mb-3 col-md-6">
						<label for="discount_type" class="form-label">Order Discount Type</label>
						<select name="discount_type" id="discount_type" class="form-select">
							<option disabled selected>-- Selected Discount Type --</option>
							<option value="0" {{ $discountType == 'no discount' ? 'selected' : '' }}>No Discount</option>
							<option value="fixed" {{ $discountType == 'fixed' ? 'selected' : '' }}>Fixed</option>
							<option value="percentage" {{ $discountType == 'percentage' ? 'selected' : '' }}>Percentage</option>
						</select>
					</div>
					<div class="mb-3 col-md-6">
						<label for="discount_value" class="form-label">Value</label>
						@if ($discountType == 'percentage')
							<input type="number" name="discount_value" class="form-control" id="discount_value" placeholder="Enter discount value" value="{{ $percentage }}">
						@else
							<input type="number" name="discount_value" class="form-control" id="discount_value" placeholder="Enter discount value" value="{{ $discountPrice }}">
						@endif
					</div>
				</div>
			</div>

			<div class="modal-footer border-0">
				<button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><i class="bx bx-x-circle me-1"></i>Close</button>
				<button type="submit" class="btn btn-success waves-effect" id="discountButton"><i class="bx bx-check-double me-1"></i>Submit Now</button>
			</div>

		</div>
	</div>
</div>
<!-- Discount Modal -->
