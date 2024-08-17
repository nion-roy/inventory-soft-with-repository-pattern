<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
  use HasFactory;

  protected $guarded = [];

  public static function updateEmail($id, $validateData)
  {
    $email = self::findOrFail($id);
    $email->mail_host = $validateData['mail_host'];
    $email->mail_port = $validateData['mail_port'];
    $email->mail_username = $validateData['mail_username'];
    $email->mail_password = $validateData['mail_password'];
    $email->mail_encryption = $validateData['mail_encryption'] ?? 'TLS';
    $email->mail_from_name = $validateData['mail_from_name'];
    $email->save();

    return $email;
  }
}
