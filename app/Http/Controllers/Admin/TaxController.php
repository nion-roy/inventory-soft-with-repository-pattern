<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaxRequest;
use App\Repositories\Interfaces\TaxRepositoryInterface;

class TaxController extends Controller
{

  protected $taxRepository;

  public function __construct(TaxRepositoryInterface $taxRepository)
  {
    $this->taxRepository = $taxRepository;
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $taxes = $this->taxRepository->getAll();
    return view('admin.tax.index', compact('taxes'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(TaxRequest $request)
  {
    $this->taxRepository->create($request->validated());
    session()->flash('success', 'Tax added successfully.');
    return response()->json(['redirect' => route('admin.tax.index')]);
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
    $tax = $this->taxRepository->getById($id);
    return response()->json(['tax' => $tax]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(TaxRequest $request, string $id)
  {
    $this->taxRepository->update($id, $request->validated());
    session()->flash('success', 'Tax update successfully.');
    return response()->json(['redirect' => route('admin.tax.index')]);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $this->taxRepository->destroy($id);
    return redirect()->back()->with('success', 'Tax delete successfull.');
  }
}
