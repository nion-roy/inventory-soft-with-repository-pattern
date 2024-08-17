<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{

  public function getAll()
  {
    return Product::latest()->paginate(10);
  }

  public function getById($id)
  {
    return Product::findOrFail($id);
  }

  public function create(array $data)
  {
    return Product::createProduct($data);
  }

  public function update(int $id, array $data)
  {
    return Product::updateProduct($id, $data);
  }

  public function destroy(int $id)
  {
    return Product::destroyProduct($id);
  }
}
