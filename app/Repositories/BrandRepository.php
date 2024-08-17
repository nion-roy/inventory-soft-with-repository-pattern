<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Repositories\Interfaces\BrandRepositoryInterface;

class BrandRepository implements BrandRepositoryInterface
{
  public function getAll()
  {
    return Brand::latest('id')->paginate(10);
  }

  public function getById(int $id)
  {
    return Brand::findOrFail($id);
  }

  public function create(array $data)
  {
    return Brand::createBrand($data);
  }

  public function update(int $id, array $data)
  {
    return Brand::updateBrand($id, $data);
  }

  public function destroy(int $id)
  {
    return Brand::destroyBrand($id);
  }
}
