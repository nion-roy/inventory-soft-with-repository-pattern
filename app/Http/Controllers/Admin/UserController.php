<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{

  protected $userRepository;

  public function __construct(UserRepositoryInterface $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $users = $this->userRepository->getAll();
    return view('admin.user.index', compact('users'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('admin.user.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(UserRequest $request)
  {
    $this->userRepository->create($request->validated());
    return redirect()->back()->with('success', 'User added successfull.');
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $user = $this->userRepository->getById($id);
    return view('admin.user.edit', compact('user'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UserRequest $request, string $id)
  {
    $this->userRepository->update($id, $request->validated());
    return redirect()->back()->with('success', 'User update successfull.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $this->userRepository->destroy($id);
    return redirect()->back()->with('success', 'User delete successfull.');
  }
}
