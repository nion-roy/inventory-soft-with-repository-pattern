<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaxesTablesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table("taxes")->insert([
      [
        'user_id' => 1,
        'name' => 'VAT 2',
        'tax' => 2,
        'status'  => true,
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'name' => 'VAT 5',
        'tax' => 5,
        'status'  => true,
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'name' => 'VAT 8',
        'tax' => 8,
        'status'  => true,
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'name' => 'VAT 10',
        'tax' => 10,
        'status'  => true,
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'name' => 'VAT 12',
        'tax' => 12,
        'status'  => true,
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'name' => 'VAT 15',
        'tax' => 15,
        'status'  => true,
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ],
    ]);
  }
}
