<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\PaymentHistory;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
  public function getAll()
  {
    return Order::latest('id')->paginate(10);
  }

  public function getById(int $id)
  {
    return Order::findOrFail($id);
  }

  public function show(int $id)
  {
    return Order::with('user')->with('payment')->findOrFail($id);
  }

  public function orderProduct(array $data)
  {
    return Order::orderCart($data);
  }

  public function destroy(int $id)
  {
    return Order::findOrFail($id)->delete();
  }

  public function newPaymentAdd(int $id, array $data)
  {
    return Order::newPaymentAdd($id, $data);
  }

  public function paymentHistroyShow(int $id)
  {
    return PaymentHistory::with('user')->where('order_id', $id)->latest('id')->get();
  }

  public function singlePaymentHistory(int $id)
  {
    return PaymentHistory::where('order_id', $id)->latest('id')->first();
  }

  public function paymentHistoryDestroy(int $id)
  {
    return PaymentHistory::findOrFail($id)->delete();
  }
}
