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
    Schema::create('orders', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table->unsignedBigInteger('customer_id');
      $table->string('order_number');
      $table->integer('total_amount');
      $table->integer('payment_amount');
      $table->integer('due_amount');
      $table->unsignedBigInteger('payment_type');
      $table->text('payment_note');
      $table->text('sale_note');
      $table->foreign('payment_type')->references('id')->on('payment_methods')->onDelete('cascade');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('orders');
  }
};
