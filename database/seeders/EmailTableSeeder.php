<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmailTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('emails')->insert([
      'mail_host' => 'nion.roy22@gmail.com',
      'mail_port' => 'nion.roy22@gmail.com',
      'mail_username' => 'nion',
      'mail_password' => '123',
      'mail_encryption' => 'nion.roy22@gmail.com',
      'mail_from_name' => 'Inventory Software',
    ]);
  }
}
