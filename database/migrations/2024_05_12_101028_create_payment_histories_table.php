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
    Schema::create('payment_histories', function (Blueprint $table) {
      $table->id(); 
      $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
      $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
      $table->integer('total_amount');
      $table->integer('payment_amount');
      $table->integer('due_amount');
      $table->foreignId('payment_type')->constrained('payment_methods')->cascadeOnDelete();
      $table->text('payment_note');
      $table->text('sale_note');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('payment_histories');
  }
};
