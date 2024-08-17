<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('products')->insert([
      [
        'user_id' => 1,
        'category_id' => 1,
        'brand_id' => 1,
        'product_name' => 'Maia Sparks',
        'slug' => 'maia-sparks',
        'product_code' => '4173196086',
        'quantity' => 60,
        'stock' => 60,
        'buying_price' => 80,
        'selling_price' => 150,
        'product_details' => '<p>Sunt, ad adipisci to.</p>',
        'image' => 'storage/products/maia-sparks-663a155bb949e.jpg',
        'status'  => true,
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'category_id' => 1,
        'brand_id' => 2,
        'product_name' => 'Lane Kelly',
        'slug' => 'lane-kelly',
        'product_code' => '7245784075',
        'quantity' => 65,
        'stock' => 65,
        'buying_price' => 95,
        'selling_price' => 120,
        'product_details' => '<p>Sunt, ad adipisci to.</p>',
        'image' => 'storage/products/lane-kelly-663a1560e9855.jpg',
        'status'  => true,
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'category_id' => 2,
        'brand_id' => 3,
        'product_name' => 'Jacob Burke',
        'slug' => 'jacob-burke',
        'product_code' => '9878268266',
        'quantity' => 25,
        'stock' => 25,
        'buying_price' => 55,
        'selling_price' => 90,
        'product_details' => '<p>Sunt, ad adipisci to.</p>',
        'image' => 'storage/products/jacob-burke-663a1565e58ab.jpg',
        'status'  => true,
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'category_id' => 3,
        'brand_id' => 1,
        'product_name' => 'Graham Pratt',
        'slug' => 'graham-pratt',
        'product_code' => '9901717114',
        'quantity' => 120,
        'stock' => 120,
        'buying_price' => 100,
        'selling_price' => 120,
        'product_details' => '<p>Sunt, ad adipisci to.</p>',
        'image' => 'storage/products/graham-pratt-663a156a4ead1.jpg',
        'status'  => true,
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'category_id' => 7,
        'brand_id' => 3,
        'product_name' => 'Gavin Joyner',
        'slug' => 'gavin-joyner',
        'product_code' => '5118937589',
        'quantity' => 72,
        'stock' => 72,
        'buying_price' => 177,
        'selling_price' => 230,
        'product_details' => '<p>Sunt, ad adipisci to.</p>',
        'image' => 'storage/products/gavin-joyner-663a15712ab07.jpg',
        'status'  => true,
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ],
      [
        'user_id' => 1,
        'category_id' => 7,
        'brand_id' => 5,
        'product_name' => 'Jamalia Bush',
        'slug' => 'jamalia-bush',
        'product_code' => '7477151985',
        'quantity' => 69,
        'stock' => 69,
        'buying_price' => 165,
        'selling_price' => 195,
        'product_details' => '<p>Sunt, ad adipisci to.</p>',
        'image' => 'storage/products/jamalia-bush-663a157d1f8b0.jpg',
        'status'  => true,
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ],
    ]);
  }
}
