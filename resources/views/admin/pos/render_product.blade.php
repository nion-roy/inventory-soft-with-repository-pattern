@forelse ($products as $product)
	<div class="col-2">
		<div class="product_lists" data-product-id="{{ $product->id }}" data-selling-price="{{ $product->selling_price }}">
			<div class="card my-2">
				<div class="card-body text-center">
					<span>{{ $product->stock }}</span>
					<img src="{{ asset($product->image) }}" class="img-fluid" alt="{{ $product->product_name }}">
					<strong>{{ $product->product_name }}</strong>
					<p>${{ number_format($product->selling_price, 2) }}</p>
				</div>
			</div>
		</div>
	</div>
@empty
	<div class="col-12 text-center">
		<h4 class="m-0">Products Not Found!</h4>
	</div>
@endforelse
