<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
  public function getAll()
  {
    return User::latest('id')->get();
  }

  public function getById(int $id)
  {
    return User::findOrFail($id);
  }

  public function create(array $data)
  {
    return User::createUser($data);
  }

  public function update(int $id, array $data)
  {
    return User::updateUser($id, $data);
  }

  public function destroy(int $id)
  {
    return User::destroyUser($id);
  }
}
