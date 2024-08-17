<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
  public function getAll()
  {
    return Category::latest('id')->paginate(10);
  }

  public function findById(int $id)
  {
    return Category::findOrFail($id);
  }

  public function create(array $data)
  {
    return Category::createCategory($data);
  }

  public function update(int $id, array $data)
  {
    return Category::updateCategory($id, $data);
  }

  public function destroy(int $id)
  {
    return Category::deleteCategory($id);
  }
}
