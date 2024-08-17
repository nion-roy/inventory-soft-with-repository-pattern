<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
  use HasFactory;
  protected $guarded = [];

  static public function active()
  {
    return Brand::where('status', true);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public static function createBrand($requestData)
  {
    $brand = new Brand();
    $brand->user_id = Auth::id();
    $brand->brand = $requestData['brand'];
    $brand->slug = Str::slug($brand->brand);
    $brand->image = self::brandImage($requestData) ?? 'brand.png';
    if (isset($requestData['status'])) {
      $brand->status = true;
    } else {
      $brand->status = false;
    }
    $brand->save();
    return $brand;
  }


  public static function updateBrand($id, $requestData)
  {
    $brand = Brand::findOrFail($id);
    $brand->user_id = Auth::id();
    $brand->brand = $requestData['brand'];
    $brand->image = self::brandImage($requestData, $brand);
    $brand->slug = Str::slug($brand->brand);
    if (isset($requestData['status'])) {
      $brand->status = true;
    } else {
      $brand->status = false;
    }
    $brand->save();
    return $brand;
  }



  public static function destroyBrand($id)
  {
    $brand = Brand::findOrFail($id);

    if ($brand && $brand->image && Storage::exists('public/brands/' . basename($brand->image))) {
      Storage::delete('public/brands/' . basename($brand->image));
    }

    $brand->delete();
    return $brand;
  }




  public static function brandImage($requestData, $brand = null)
  {
    if (isset($requestData['image'])) {
      $image = $requestData['image'];
      $slug = Str::slug($requestData['brand']);
      $imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
      $image->storeAs('public/brands', $imageName);

      // If updating user and previous image exists, unlink it
      if ($brand && $brand->image && Storage::exists('public/brands/' . basename($brand->image))) {
        Storage::delete('public/brands/' . basename($brand->image));
      }

      return 'storage/brands/' . $imageName;
    } elseif ($brand && $brand->image) {
      return $brand->image;
    }
    return null;
  }
}
