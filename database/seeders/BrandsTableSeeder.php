<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('brands')->insert([
      [
        'user_id' => 1,
        'brand' => 'Neville Holman',
        'slug' => 'neville-holman',
        'image' => 'storage/brands/neville-holman-664050df7dde3.jpg',
        'status' => true,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'brand' => 'Edward Vazquez',
        'slug' => 'edward-vazquez',
        'image' => 'storage/brands/edward-vazquez-6640518b517f0.jpg',
        'status' => true,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'brand' => 'Honorato Carlson',
        'slug' => 'honorato-carlson',
        'image' => 'storage/brands/honorato-carlson-664051913ac61.jpg',
        'status' => true,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'brand' => 'Hilda Foster',
        'slug' => 'hilda-foster',
        'image' => 'storage/brands/hilda-foster-664051962d9b3.jpg',
        'status' => true,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'brand' => 'Uriah Knight',
        'slug' => 'uriah-knight',
        'image' => 'storage/brands/uriah-knight-6640519b62d97.jpg',
        'status' => true,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'brand' => 'Kylie Ellis',
        'slug' => 'kylie-ellis',
        'image' => 'storage/brands/kylie-ellis-664051a1a7009.jpg',
        'status' => true,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ],
    ]);
  }
}
