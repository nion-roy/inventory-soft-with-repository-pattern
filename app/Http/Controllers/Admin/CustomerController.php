<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Repositories\Interfaces\CustomerRepositoryInterface;

class CustomerController extends Controller
{

  protected $customerRepository;

  public function __construct(CustomerRepositoryInterface $customerRepository)
  {
    $this->customerRepository = $customerRepository;
  }


  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $customers = $this->customerRepository->getAll();
    return view('admin.customer.index', compact('customers'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('admin.customer.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(CustomerRequest $request)
  {
    $this->customerRepository->create($request->validated());
    return redirect()->back()->with('success', 'Customer added successfull.');
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $customer = $this->customerRepository->getById($id);
    return view('admin.customer.edit', compact('customer'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(CustomerRequest $request, string $id)
  {
    $this->customerRepository->update($id, $request->validated());
    return redirect()->back()->with('success', 'Customer update successfull.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $this->customerRepository->destroy($id);
    return redirect()->back()->with('success', 'Customer delete successfull.');
  }
}
