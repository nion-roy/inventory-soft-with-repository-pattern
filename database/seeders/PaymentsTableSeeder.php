<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('payment_methods')->insert([
      [
        'user_id' => 1,
        'name' => 'Cash',
        'slug' => 'cash',
        'status' => 1,
        'image' => 'payment.png',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'name' => 'Bkash',
        'slug' => 'bkash',
        'status' => 1,
        'image' => 'payment.png',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'name' => 'Nagad',
        'slug' => 'nagad',
        'status' => 1,
        'image' => 'payment.png',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'name' => 'Rocket',
        'slug' => 'rocket',
        'status' => 1,
        'image' => 'payment.png',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'name' => 'Credit Card',
        'slug' => 'credit-card',
        'status' => 1,
        'image' => 'payment.png',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'name' => 'Bank Transfer',
        'slug' => 'bank-transfer',
        'status' => 1,
        'image' => 'payment.png',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'name' => 'Other Payment Method',
        'slug' => 'other-payment-method 	',
        'status' => 1,
        'image' => 'payment.png',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
    ]);
  }
}
