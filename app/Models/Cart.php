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




  public static function orderCart($requestData)
  {
    // Create a new order instance
    $order = new Order();
    $order->user_id = Auth::id();
    $order->customer_id = $requestData['customer_id'];
    $order->order_number = getOrderCode();
    $order->total_amount = $requestData['total_amount'];
    $order->payment_amount = $requestData['paying_amount'];
    $order->due_amount = $requestData['due_amount'];
    $order->payment_type = $requestData['payment_type'];
    $order->payment_note = $requestData['payment_note'];
    $order->sale_note = $requestData['sale_note'];
    $order->save();

    $paymentHistory = new PaymentHistory();
    $paymentHistory->user_id = Auth::id();
    $paymentHistory->customer_id = $requestData['customer_id'];
    $paymentHistory->order_id = $order->id;
    $paymentHistory->total_amount = $requestData['total_amount'];
    $paymentHistory->payment_amount = $requestData['paying_amount'];
    $paymentHistory->due_amount = $requestData['due_amount'];
    $paymentHistory->payment_type = $requestData['payment_type'];
    $paymentHistory->payment_note = $requestData['payment_note'];
    $paymentHistory->sale_note = $requestData['sale_note'];
    $paymentHistory->save();

    // Retrieve all items in the cart
    $carts = Cart::all();

    // Iterate through each cart item and create order details
    foreach ($carts as $cart) {
      $orderDetails = new OrderDetails();
      $orderDetails->user_id = $order->user_id;
      $orderDetails->order_id = $order->id;
      $orderDetails->product_id = $cart->product_id;
      $orderDetails->quantity = $cart->quantity;
      $orderDetails->price = $cart->price;
      $orderDetails->discount_type = $cart->discount_type;
      $orderDetails->discount_price = $cart->discount_price;
      $orderDetails->tax = $cart->tax;
      $orderDetails->shipping_type = $cart->shipping_type;
      $orderDetails->shipping_charge = $cart->shipping_charge;
      $orderDetails->save();

      $product = Product::findOrFail($orderDetails->product_id);
      $product->stock = $product->stock - $orderDetails->quantity;
      $product->save();
    }

    // Clear the cart after completing the order
    Cart::truncate();
    return $product;
  }
}
