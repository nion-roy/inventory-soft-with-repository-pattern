<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('products', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('category_id');
      $table->unsignedBigInteger('brand_id');
      $table->string('product_name');
      $table->string('product_code')->unique()->nullable();
      $table->string('slug');
      $table->integer('quantity');
      $table->integer('stock')->default(0);
      $table->integer('buying_price')->default(100);
      $table->integer('selling_price')->default(120);
      $table->text('product_details');
      $table->string('image')->default('product.png');
      $table->boolean('status')->default(false);
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
      $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('products');
  }
};
