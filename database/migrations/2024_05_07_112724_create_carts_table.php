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
    Schema::create('carts', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('product_id');
      $table->integer('quantity')->default(0);
      $table->integer('price')->default(0);
      $table->string('discount_type')->nullable();
      $table->integer('discount_price')->nullable()->default(0);
      $table->integer('tax')->nullable()->default(0);
      $table->string('shipping_type')->nullable();
      $table->integer('shipping_charge')->nullable()->default(0);
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('carts');
  }
};
