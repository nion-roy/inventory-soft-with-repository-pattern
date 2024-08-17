<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    for ($i = 0; $i < 10; $i++) {
      DB::table('customers')->insert([
        'user_id' => 1,
        'name' => fake()->name(),
        'slug' => fake()->slug(),
        'email' => fake()->unique()->safeEmail(),
        'contact' => '017' . rand(00000000, 99999999),
        'address' => 'Rangpur, Dhaka, Bangladesh',
        'status' => 1,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);
    }
  }
}
