<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
  use HasFactory;

  protected $guarded = [];

  public function product()
  {
    return $this->belongsTo(Product::class);
  }

  static public function active()
  {
    return Product::where('status', true);
  }

  public static function createCart($requestData)
  {
    $productId = $requestData['productId'];
    $existingCartItem = Cart::where('product_id', $productId)->where('user_id', Auth::id())->first();
    if ($existingCartItem) {
      $cartItem = Cart::findOrFail($existingCartItem->id);
      $cartItem->product_id = $productId;
      $cartItem->quantity += 1;
      $cartItem->save();
    } else {
      $cartItem = new Cart();
      $cartItem->user_id = Auth::id();
      $cartItem->product_id = $productId;
      $cartItem->quantity = 1;
      $cartItem->price = $requestData['sellingPrice'];
      $cartItem->save();
    }

    return $cartItem;
  }


  public static function incrementCart($id)
  {
    $cartItem = Cart::findOrFail($id);
    $cartItem->quantity += 1;
    $cartItem->save();
    return $cartItem;
  }

  public static function decrementCart($id)
  {
    $cartItem = Cart::findOrFail($id);

    if ($cartItem->quantity > 1) {
      $cartItem->quantity -= 1;
      $cartItem->save();
    } else {
      $cartItem->quantity = 1;
      $cartItem->save();
    }

    return $cartItem;
  }
  public static function manualCart($id, $requestData)
  {
    $cartItem = Cart::findOrFail($id);
    if ($requestData['quantity'] < 1) {
      $cartItem->delete();
    } else {
      $cartItem->quantity = $requestData['quantity'];
      $cartItem->save();
    }
    $cartItem->quantity = $requestData['quantity'];

    return $cartItem;
  }



  public static function productFilterCart($requestData)
  {
    $products = Product::query();

    if ($requestData['search']) {
      $products = $products->where('product_name', 'like', '%' . $requestData['search'] . '%');
    }

    if ($requestData['category']) {
      $products = $products->where('category_id', $requestData['category']);
    }

    if ($requestData['brand']) {
      $products = $products->where('brand_id', $requestData['brand']);
    }

    $products = $products->latest()->get();
    return $products;
  }



  public static function taxToCart($requestData)
  {
    $carts = Cart::where('user_id', Auth::id())->get();
    foreach ($carts as $cart) {
      $cart->tax = calculateTaxFromPrice($cart->price, $requestData['taxValue']);
      $cart->save();
    }

    return $cart;
  }


  public static function discountToCart($requestData)
  {
    $carts = Cart::where('user_id', Auth::id())->get();
    $total = 0;

    // Calculate the total price by summing up the price multiplied by quantity for each cart item
    foreach ($carts as $cart) {
      $total += $cart->price * $cart->quantity;
    }
    // Iterate through each cart item to apply the discount
    foreach ($carts as $cart) {
      $cart->discount_type = $requestData['discountType'];
      if ($requestData['discountType'] == 'fixed') {
        $cart->discount_price = $requestData['discountValue'];
      } elseif ($requestData['discountType'] == 'percentage') {
        $cart->discount_price = ($requestData['discountValue'] / 100) * $total;
      } else {
        $cart->discount_type = 'no discount';
        $cart->discount_price = 0;
      }
      $cart->save();
    }

    return $cart;
  }


  public static function shippingToCart($requestData)
  {
    $carts = Cart::where('user_id', Auth::id())->get();

    foreach ($carts as $cart) {
      $cart->shipping_type = $requestData['shippingType'];
      if ($requestData['shippingType'] == 'inside' || $requestData['shippingType'] == 'outside') {
        $cart->shipping_charge = $requestData['shippingValue'];
      } else {
        $cart->shipping_type = 'no shipping';
        $cart->shipping_charge = 0;
      }
      $cart->save();
    }
    return $cart;
  }
}
