<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
  use HasFactory;

  protected $guarded = [];

  public function customer()
  {
    return $this->belongsTo(Customer::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function payment()
  {
    return $this->belongsTo(PaymentMethod::class, 'payment_type', 'id');
  }


  public function orderDetails()
  {
    return $this->hasMany(OrderDetails::class);
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



  public static function newPaymentAdd($id, $requestData)
  {
    $newPayment = new PaymentHistory();
    $newPayment->user_id = Auth::id();
    $newPayment->order_id = $id;
    $newPayment->total_amount = $requestData['total_amount'];
    $newPayment->payment_amount = $requestData['paying_amount'];
    $newPayment->due_amount = $requestData['due_amount'];
    $newPayment->payment_type = $requestData['payment_type'];
    $newPayment->payment_note = $requestData['payment_note'];
    $newPayment->sale_note = $requestData['sale_note'];
    $newPayment->save();

    $orderPaymentUpdate = Order::where('id', $id)->first();
    $orderPaymentUpdate->user_id = Auth::id();
    $newPayment->total_amount = $requestData['total_amount'];
    $newPayment->payment_amount = $requestData['paying_amount'];
    $newPayment->due_amount = $requestData['due_amount'];
    $newPayment->payment_type = $requestData['payment_type'];
    $newPayment->payment_note = $requestData['payment_note'];
    $newPayment->sale_note = $requestData['sale_note'];
    $orderPaymentUpdate->update();
  }
}
