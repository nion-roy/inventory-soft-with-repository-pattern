<?php

namespace App\Repositories\Interfaces;

interface OrderRepositoryInterface
{
  public function getAll();
  public function getById(int $id);
  public function orderProduct(array $data);
  public function show(int $id);
  public function destroy(int $id);
  public function newPaymentAdd(int $id, array $data);
  public function paymentHistroyShow(int $id);
  public function paymentHistoryDestroy(int $id);
  public function singlePaymentHistory(int $id);
}
