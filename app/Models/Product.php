<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
  use HasFactory;
  protected $guarded = [];

  static public function active()
  {
    return Product::where('status', true);
  }

  public function category()
  {
    return $this->belongsTo(Category::class);
  }


  public function brand()
  {
    return $this->belongsTo(Brand::class);
  }

  public static function createProduct($requestData)
  {
    $product = new Product();
    $product->user_id = Auth::user()->id;
    $product->category_id = $requestData["category_id"];
    $product->product_name = $requestData["product_name"];
    $product->slug = Str::slug($product->product_name);
    $product->product_code = getProductCode();
    $product->quantity = $requestData["quantity"];
    $product->buying_price = $requestData["buying_price"];
    $product->selling_price = $requestData["selling_price"];
    $product->product_details = $requestData["product_details"];
    $product->image = self::productImage($requestData) ?? 'product.png';

    if (isset($requestData["status"])) {
      $product->status = true;
    } else {
      $product->status = false;
    }

    $product->save();
    return $product;
  }


  public static function updateProduct($id, $requestData)
  {
    $product = Product::findOrFail($id);
    $product->category_id = $requestData["category_id"];
    $product->product_name = $requestData["product_name"];
    $product->slug = Str::slug($product->product_name);
    $product->quantity = $requestData["quantity"];
    $product->buying_price = $requestData["buying_price"];
    $product->selling_price = $requestData["selling_price"];
    $product->product_details = $requestData["product_details"];
    $product->image = self::productImage($requestData, $product);

    if (isset($requestData["status"])) {
      $product->status = true;
    } else {
      $product->status = false;
    }

    $product->update();
    return $product;
  }


  public static function destroyProduct($id)
  {
    $product = Product::findOrFail($id);

    if ($product && $product->image && Storage::exists('public/products/' . basename($product->image))) {
      Storage::delete('public/products/' . basename($product->image));
    }

    $product->delete();
    return $product;
  }


  public static function productImage($requestData, $product = null)
  {
    if (isset($requestData['image'])) {
      $image = $requestData['image'];
      $slug = Str::slug($requestData['product_name']);
      $imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
      $image->storeAs('public/products', $imageName);

      // If updating user and previous image exists, unlink it
      if ($product && $product->image && Storage::exists('public/products/' . basename($product->image))) {
        Storage::delete('public/products/' . basename($product->image));
      }

      return 'storage/products/' . $imageName;
    } elseif ($product && $product->image) {
      return $product->image;
    }
    return null;
  }
}
