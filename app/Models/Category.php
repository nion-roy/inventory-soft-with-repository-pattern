<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
  use HasFactory;

  protected $guarded = [];

  static public function active()
  {
    return Category::where('status', true);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }


  public static function createCategory($requestData)
  {
    $category = new Category();
    $category->user_id = Auth::id();
    $category->category = $requestData['category'];
    $category->slug = Str::slug($category->category);
    if (isset($requestData['status'])) {
      $category->status = true;
    } else {
      $category->status = false;
    }
    $category->save();
    return $category;
  }


  public static function updateCategory($id, $requestData)
  {
    $category = Category::findOrFail($id);
    $category->category = $requestData['category'];
    $category->slug = Str::slug($category->category);
    if (isset($requestData['status'])) {
      $category->status = true;
    } else {
      $category->status = false;
    }
    $category->update();
    return $category;
  }

  public static function deleteCategory($id)
  {
    return Category::findOrFail($id)->delete();
  }
}
