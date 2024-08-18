<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentMethodRequest;
use App\Repositories\Interfaces\PaymentMethodRepositoryInterface;

class PaymentMethodController extends Controller
{

  protected $paymentMethoadRepository;

  public function __construct(PaymentMethodRepositoryInterface $paymentMethoadRepository)
  {
    $this->paymentMethoadRepository = $paymentMethoadRepository;
  }
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $payments = $this->paymentMethoadRepository->getAll();
    return view('admin.payment.index', compact('payments'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('admin.payment.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(PaymentMethodRequest $request)
  {
    $this->paymentMethoadRepository->create($request->validated());
    return redirect()->back()->with('success', 'Payment method added successfull.');
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    $payment = $this->paymentMethoadRepository->getById($id);
    return view('admin.payment.edit', compact('payment'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(PaymentMethodRequest $request, string $id)
  {
    $this->paymentMethoadRepository->update($id, $request->validated());
    return redirect()->back()->with('success', 'Payment method update successfull.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $this->paymentMethoadRepository->destroy($id);
    return redirect()->back()->with('success', 'Payment method delete successfull.');
  }
}
