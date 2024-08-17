<?php

namespace App\Repositories;

use App\Models\PaymentMethod;
use App\Repositories\Interfaces\PaymentMethodRepositoryInterface;

class PaymentMethodRepository implements PaymentMethodRepositoryInterface
{
  public function getAll()
  {
    return PaymentMethod::latest('id')->paginate(10);
  }

  public function getById(int $id)
  {
    return PaymentMethod::findOrFail($id);
  }

  public function create(array $data)
  {
    return PaymentMethod::createPaymentMethod($data);
  }

  public function update(int $id, array $data)
  {
    return PaymentMethod::updatePaymentMethod($id, $data);
  }

  public function destroy(int $id)
  {
    return PaymentMethod::destroyPaymentMethod($id);
  }
}
