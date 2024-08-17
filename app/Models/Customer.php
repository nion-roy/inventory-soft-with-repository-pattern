<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
  use HasFactory;

  protected $guarded = [];

  static public function active()
  {
    return Customer::where('status', true);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }


  public static function createCustomer($requestData)
  {
    $customer = new Customer();
    $customer->user_id = Auth::user()->id;
    $customer->name = $requestData['name'];
    $customer->slug = Str::slug($customer->name);
    $customer->email = $requestData['email'];
    $customer->contact = $requestData['contact'];
    $customer->address = $requestData['address'];

    if (isset($requestData['status'])) {
      $customer->status = true;
    } else {
      $customer->status = false;
    }

    $customer->save();
    return $customer;
  }

  public static function updateCustomer($id, $requestData)
  {
    $customer = Customer::findOrFail($id);
    $customer->name = $requestData['name'];
    $customer->slug = Str::slug($customer->name);
    $customer->email = $requestData['email'];
    $customer->contact = $requestData['contact'];
    $customer->address = $requestData['address'];

    if (isset($requestData['status'])) {
      $customer->status = true;
    } else {
      $customer->status = false;
    }

    $customer->update();
    return $customer;
  }
}
