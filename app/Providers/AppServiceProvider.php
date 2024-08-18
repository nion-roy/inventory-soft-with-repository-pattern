<?php

namespace App\Providers;

use App\Repositories\TaxRepository;
use App\Repositories\CartRepository;
use App\Repositories\UserRepository;
use Illuminate\Pagination\Paginator;
use App\Repositories\BrandRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\PaymentMethodRepository;
use App\Repositories\Interfaces\TaxRepositoryInterface;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Repositories\Interfaces\PaymentMethodRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
    $this->app->bind(BrandRepositoryInterface::class, BrandRepository::class);
    $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
    $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    $this->app->bind(TaxRepositoryInterface::class, TaxRepository::class);
    $this->app->bind(PaymentMethodRepositoryInterface::class, PaymentMethodRepository::class);
    $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
    $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    Paginator::useBootstrap();
  }
}
