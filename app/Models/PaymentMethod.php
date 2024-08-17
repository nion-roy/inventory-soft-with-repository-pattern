<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMethod extends Model
{
  use HasFactory;

  protected $guarded = [];

  static public function active()
  {
    return PaymentMethod::where('status', true);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }


  public static function createPaymentMethod($requestData)
  {
    $payment = new PaymentMethod();
    $payment->user_id = Auth::id();
    $payment->name = $requestData['name'];
    $payment->slug = Str::slug($payment->name);
    $payment->image = self::paymentImage($requestData) ?? 'payment.png';
    if (isset($requestData['status'])) {
      $payment->status = true;
    } else {
      $payment->status = false;
    }
    $payment->save();
    return $payment;
  }


  public static function updatePaymentMethod($id, $requestData)
  {
    $payment = PaymentMethod::findOrFail($id);
    $payment->name = $requestData['name'];
    $payment->slug = Str::slug($payment->name);

    // Update image only if a new one is provided
    $payment->image = self::paymentImage($requestData, $payment);

    if (isset($requestData['status'])) {
      $payment->status = true;
    } else {
      $payment->status = false;
    }
    $payment->save();
    return $payment;
  }



  public static function destroyPaymentMethod($id)
  {
    $payment = PaymentMethod::findOrFail($id);

    if ($payment && $payment->image && Storage::exists('public/payments/' . basename($payment->image))) {
      Storage::delete('public/payments/' . basename($payment->image));
    }

    $payment->delete();
    return $payment;
  }


  public static function paymentImage($requestData, $payment = null)
  {
    if (isset($requestData['image'])) {
      $image = $requestData['image'];
      $slug = Str::slug($requestData['name']);
      $imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
      $image->storeAs('public/payments', $imageName);

      // If updating user and previous image exists, unlink it
      if ($payment && $payment->image && Storage::exists('public/payments/' . basename($payment->image))) {
        Storage::delete('public/payments/' . basename($payment->image));
      }

      return 'storage/payments/' . $imageName;
    } elseif ($payment && $payment->image) {
      return $payment->image;
    }
    return null;
  }
}
