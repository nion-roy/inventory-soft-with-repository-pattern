<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Auth;

class CategoriesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('categories')->insert([
      [
        'user_id' => 1,
        'category'    => 'Electronics',
        'slug' => 'electronics',
        'status'  => true,
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'category'    => 'Apparel & Accessories',
        'slug' => 'apparel-accessories',
        'status'  => true,
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'category'    => 'Home & Garden',
        'slug' => 'home-garden',
        'status'  => true,
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'category'    => 'Beauty & Personal Care',
        'slug' => 'beauty-personal-care',
        'status'  => true,
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'category'    => 'Sports & Outdoors',
        'slug' => 'sports-outdoors',
        'status'  => true,
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'category'    => 'Books & Stationery',
        'slug' => 'books-stationery',
        'status'  => true,
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'category'    => 'Health & Wellness',
        'slug' => 'health-wellness',
        'status'  => true,
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'category'    => 'Toys & Games',
        'slug' => 'toys-games',
        'status'  => true,
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'category'    => 'Automotive & Tools',
        'slug' => 'automotive-tools',
        'status'  => true,
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'category'    => 'Food & Beverages',
        'slug' => 'food-beverages',
        'status'  => true,
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ],
    ]);
  }
}
