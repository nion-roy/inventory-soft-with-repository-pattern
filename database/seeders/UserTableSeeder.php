<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('users')->insert([
      [
        'name'    => 'Admin',
        'email'   => 'admin@gmail.com',
        'slug' => 'admin',
        'status'  => 1,
        'image'  => 'user.png',
        'password'  => Hash::make('12345678'),
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ],
      [
        'name'    => 'Co-Admin',
        'email'   => 'coadmin@gmail.com',
        'slug' => 'co-admin',
        'status'  => 1,
        'image'  => 'user.png',
        'password'  => Hash::make('12345678'),
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ],
      [
        'name'    => 'User',
        'email'   => 'user@gmail.com',
        'slug' => 'user',
        'status'  => 1,
        'image'  => 'user.png',
        'password'  => Hash::make('12345678'),
        'created_at'  => Carbon::now(),
        'updated_at'  => Carbon::now(),
      ]
    ]);
  }
}
