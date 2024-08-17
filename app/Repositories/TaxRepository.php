<?php

namespace App\Repositories;

use App\Models\Tax;
use App\Repositories\Interfaces\TaxRepositoryInterface;

class TaxRepository implements TaxRepositoryInterface
{
  public function getAll()
  {
    return Tax::latest('id')->paginate(10);
  }

  public function getById(int $id)
  {
    return Tax::findOrFail($id);
  }

  public function create(array $data)
  {
    return Tax::createTax($data);
  }

  public function update(int $id, array $data)
  {
    return Tax::updateTax($id, $data);
  }

  public function destroy(int $id)
  {
    return Tax::destroyTax($id);
  }
}
