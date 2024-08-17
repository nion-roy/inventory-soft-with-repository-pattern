<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tax extends Model
{
  use HasFactory;
  protected $guarded = [];

  static public function active()
  {
    return Tax::where('status', true);
  }
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public static function createTax($requestData)
  {
    $tax = new Tax();
    $tax->user_id = Auth::id();
    $tax->name = $requestData['name'];
    $tax->tax = $requestData['tax'];
    $tax->status = $requestData['status'];
    $tax->save();
    return $tax;
  }


  public static function updateTax($id, $requestData)
  {
    $tax = Tax::findOrFail($id);
    $tax->name = $requestData['name'];
    $tax->tax = $requestData['tax'];
    $tax->status = $requestData['status'];
    $tax->update();
    return $tax;
  }

  public static function destroyTax($id)
  {
    return Tax::findOrFail($id)->delete();
  }
}
