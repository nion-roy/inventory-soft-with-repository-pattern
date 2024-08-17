<!-- Tax Modal -->
<div class="modal fade" id="orderTax" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content p-3">
			<div class="modal-header pb-2">
				<h4 class="modal-title" id="productLabel">Order Tax</h4>
				<button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body mt-2">

				<div class="row">
					<div class="mb-3 col-md-12">
						<label for="order_tax" class="form-label">Order Tax (%)</label>
						<select name="order_tax" id="order_tax" class="form-select">
							<option selected disabled>-- Selected Order Tax --</option>
							<option value="0">No Tax</option>

							@php
								$cart = App\Models\Cart::select('price', 'tax')->first();
								$price = $cart->price ?? null;
								$taxValue = $cart->tax ?? null;
								$taxCalculate = round(calculatePriceFromTax($price, $taxValue));
							@endphp

							@foreach ($taxes as $tax)
								<option value="{{ $tax->tax }}" {{ $tax->tax == $taxCalculate ? 'selected' : '' }}>{{ $tax->tax }}%</option>
							@endforeach

						</select>
					</div>
				</div>
			</div>

			<div class="modal-footer border-0">
				<button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"><i class="bx bx-x-circle me-1"></i>Close</button>
				<button type="submit" class="btn btn-success waves-effect" id="taxButton"><i class="bx bx-check-double me-1"></i>Submit Now</button>
			</div>

		</div>
	</div>
</div>
<!-- Tax Modal -->
