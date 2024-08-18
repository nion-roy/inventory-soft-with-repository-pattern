<?php

use Illuminate\Support\Facades\Route;


Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
  Route::get('dashboard', [App\Http\Controllers\Admin\HomeController::class, 'nion_index'])->name('dashboard');
  Route::get('logout', [App\Http\Controllers\Admin\HomeController::class, 'nion_logout'])->name('logout');


  Route::resource('category', App\Http\Controllers\Admin\CategoryController::class);
  Route::resource('brand', App\Http\Controllers\Admin\BrandController::class);
  Route::resource('product', App\Http\Controllers\Admin\ProductController::class);
  Route::resource('customer', App\Http\Controllers\Admin\CustomerController::class);
  Route::resource('user', App\Http\Controllers\Admin\UserController::class);

  Route::resource('pos', App\Http\Controllers\Admin\POSController::class);
  Route::post('add-to-cart', [App\Http\Controllers\Admin\POSController::class, 'addToCart'])->name('cart.add');
  Route::get('product-to-cart', [App\Http\Controllers\Admin\POSController::class, 'productToCart'])->name('cart.show');
  Route::delete('remove-from-cart/{id}', [App\Http\Controllers\Admin\POSController::class, 'removeToCart'])->name('cart.remove');
  Route::get('product-quantity-increment/{id}', [App\Http\Controllers\Admin\POSController::class, 'incrementToCart'])->name('cart.increment');
  Route::get('product-quantity-decrement/{id}', [App\Http\Controllers\Admin\POSController::class, 'decrementToCart'])->name('cart.decrement');
  Route::post('product-quantity-manual/{id}', [App\Http\Controllers\Admin\POSController::class, 'manualToCart'])->name('cart.manual');
  Route::get('cart-reset', [App\Http\Controllers\Admin\POSController::class, 'resetToCart'])->name('cart.reset');
  Route::get('product-filter', [App\Http\Controllers\Admin\POSController::class, 'filterProducts'])->name('product.filter');



  Route::get('cart-tax', [App\Http\Controllers\Admin\POSController::class, 'taxToCart'])->name('cart.tax');
  Route::get('cart-discount', [App\Http\Controllers\Admin\POSController::class, 'discountToCart'])->name('cart.discount');
  Route::get('cart-shipping-charge', [App\Http\Controllers\Admin\POSController::class, 'shippingToCart'])->name('cart.shipping');


  Route::get('order', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('order.index');
  Route::post('order', [App\Http\Controllers\Admin\OrderController::class, 'order'])->name('order.store');
  Route::get('order/{id}/view', [App\Http\Controllers\Admin\OrderController::class, 'view'])->name('order.view');
  Route::delete('order/destroy/{id}', [App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('order.destroy');
  Route::get('payment-history/{id}', [App\Http\Controllers\Admin\OrderController::class, 'paymentHistory'])->name('payment.history');
  Route::get('payment-history-order/{id}', [App\Http\Controllers\Admin\OrderController::class, 'singlePaymentHistory'])->name('payment.single.history');
  Route::post('payment-add/{id}', [App\Http\Controllers\Admin\OrderController::class, 'paymentAdd'])->name('payment.add');
  Route::get('payment-history-delete/{id}', [App\Http\Controllers\Admin\OrderController::class, 'paymentDestroy'])->name('payment.destroy');




  Route::resource('payment-method', App\Http\Controllers\Admin\PaymentMethodController::class);
  Route::resource('tax', App\Http\Controllers\Admin\TaxController::class);

  Route::get('email', [App\Http\Controllers\Admin\EmailController::class, 'edit'])->name('email.edit');
  Route::post('email/{id}', [App\Http\Controllers\Admin\EmailController::class, 'update'])->name('email.update');
});
