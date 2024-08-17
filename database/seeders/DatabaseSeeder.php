<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call(UserTableSeeder::class);
    $this->call(CategoriesTableSeeder::class);
    $this->call(BrandsTableSeeder::class);
    $this->call(PaymentsTableSeeder::class);
    $this->call(ProductsTableSeeder::class);
    $this->call(TaxesTablesSeeder::class);
    $this->call(CustomersTableSeeder::class);
    $this->call(EmailTableSeeder::class);
  }
}
