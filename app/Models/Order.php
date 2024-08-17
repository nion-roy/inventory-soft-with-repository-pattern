<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
