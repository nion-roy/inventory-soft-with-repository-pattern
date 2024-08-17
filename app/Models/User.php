<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
  use HasFactory, Notifiable;


  static public function active()
  {
    return User::where('status', true);
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }


  public static function createUser($requestData)
  {
    $user = new User();
    $user->name = $requestData['name'];
    $user->slug = Str::slug($user->name);
    $user->email = $requestData['email'];
    $user->password = Hash::make($requestData['password']);
    $user->image = self::userImage($requestData) ?? 'user.png';
    $user->status = $requestData['status'];
    $user->save();
    return $user;
  }

  public static function updateUser($id, $requestData)
  {
    $user = User::findOrFail($id);
    $user->name = $requestData['name'];
    $user->slug = Str::slug($user->name);
    $user->email = $requestData['email'];
    $user->password = Hash::make($requestData['password']);
    $user->image = self::userImage($requestData, $user) ?? 'user.png';
    $user->status = $requestData['status'];
    $user->update();
    return $user;
  }


  public static function destroyUser($id)
  {
    $user = User::findOrFail($id);

    if ($user && $user->image && Storage::exists('public/users/' . basename($user->image))) {
      Storage::delete('public/users/' . basename($user->image));
    }

    $user->delete();
    return $user;
  }




  public static function userImage($requestData, $user = null)
  {
    if (isset($requestData['image'])) {
      $image = $requestData['image'];
      $slug = Str::slug($requestData['name']);
      $imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
      $image->storeAs('public/users', $imageName);

      // If updating user and previous image exists, unlink it
      if ($user && $user->image && Storage::exists('public/users/' . basename($user->image))) {
        Storage::delete('public/users/' . basename($user->image));
      }

      return 'storage/users/' . $imageName;
    } elseif ($user && $user->image) {
      return $user->image;
    }
    return null;
  }
}
