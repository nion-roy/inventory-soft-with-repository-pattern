@if (isset($carts))
	@forelse ($carts as $cart)
		<div id="cart-item-{{ $cart->id }}" data-cart-id="{{ $cart->id }}" class="pos-content d-flex align-items-center justify-content-between">
			<div class="d-flex align-items-center gap-2">
				<div class="product-img">
					<img src="{{ asset($cart->product->image) }}" width="40px" alt="{{ $cart->product->product_name }}">
					<button type="button" class="remove-product"><i class="bx bx-x"></i></button>
				</div>
				<div class="product-details">
					<h4>{{ $cart->product->product_name }}</h4>
					<h5>${{ number_format($cart->product->selling_price, 2) }}</h5>
				</div>
			</div>
			<div class="product-qty">
				<button class="decrement" type="button"><i class="bx bx-minus"></i></button>
				<input type="number" class="form-control quantity-input" min="1" value="{{ $cart->quantity }}">
				<button class="increment" type="button"><i class="bx bx-plus"></i></button>
			</div>
		</div>
	@empty
		<h4 class="text-center">Your Cart is Empty.!</h4>
	@endforelse
@endif

