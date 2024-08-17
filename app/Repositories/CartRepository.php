<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Repositories\Interfaces\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{
  public function getById(int $id)
  {
    return Cart::findOrFail($id);
  }

  public function create(array $data)
  {
    return Cart::createCart($data);
  }

  public function destroy(int $id)
  {
    return Cart::findOrFail($id)->delete();
  }


  public function incrementQuantity(int $id)
  {
    return Cart::incrementCart($id);
  }


  public function decrementQuantity(int $id)
  {
    return Cart::decrementCart($id);
  }


  public function manualQuantity(int $id, array $data)
  {
    return Cart::manualCart($id, $data);
  }



  public function orderProduct(array $data)
  {
    return Cart::orderCart($data);
  }


}
