<?php

namespace App\Repositories\Interfaces;

interface CartRepositoryInterface
{
  public function getById(int $id);
  public function create(array $data);
  public function destroy(int $id);
  public function incrementQuantity(int $id);
  public function decrementQuantity(int $id);
  public function manualQuantity(int $id, array $data); 
  public function orderProduct(array $data);
  public function productFilter(array $data);
  public function taxCart(array $data);
  public function discountCart(array $data);
  public function shippingCart(array $data);
}
