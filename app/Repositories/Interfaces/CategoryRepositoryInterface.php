<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
  public function getAll();

  public function findById(int $id);

  public function create(array $data);

  public function update(int $id, array $data);

  public function destroy(int $id);
}
