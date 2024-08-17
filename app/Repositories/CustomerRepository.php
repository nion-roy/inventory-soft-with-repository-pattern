<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Repositories\Interfaces\CustomerRepositoryInterface;

class CustomerRepository implements CustomerRepositoryInterface
{

  public function getAll()
  {
    return Customer::latest('id')->paginate(10);
  }

  public function getById($id)
  {
    return Customer::findOrFail($id);
  }

  public function create(array $data)
  {
    return Customer::createCustomer($data);
  }

  public function update(int $id, array $data)
  {
    return Customer::updateCustomer($id, $data);
  }

  public function destroy(int $id)
  {
    return Customer::findOrFail($id)->delete();
  }
}
