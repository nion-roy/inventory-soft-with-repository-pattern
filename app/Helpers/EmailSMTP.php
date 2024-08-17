<?php
use Illuminate\Support\Facades\Config;

function mailSMTP()
{
  $mail = \App\Models\Email::first();

  // Dynamically set the mail configuration
  Config::set('mail.mailers.smtp.host', $mail->mail_host);
  Config::set('mail.mailers.smtp.port', $mail->mail_port);
  Config::set('mail.mailers.smtp.username', $mail->mail_username);
  Config::set('mail.mailers.smtp.password', $mail->mail_password);
  Config::set('mail.mailers.smtp.encryption', $mail->mail_encryption);
  Config::set('mail.from.address', $mail->mail_host);
  Config::set('mail.from.name', $mail->mail_from_name);
}
