<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Repositories\Interfaces\BrandRepositoryInterface;

class BrandController extends Controller
{

  protected $brandRepository;


  public function __construct(BrandRepositoryInterface $brandRepository)
  {
    $this->brandRepository = $brandRepository;
  }


  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $brands = $this->brandRepository->getAll();
    return view('admin.brand.index', compact('brands'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('admin.brand.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(BrandRequest $request)
  {
    $this->brandRepository->create($request->validated());
    return redirect()->back()->with('success', 'Brand added successfull.');
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
    $brand = $this->brandRepository->getById($id);
    return view('admin.brand.edit', compact('brand'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(BrandRequest $request, string $id)
  {
    $this->brandRepository->update($id, $request->validated());
    return redirect()->back()->with('success', 'Brand update successfull.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $this->brandRepository->destroy($id);
    return redirect()->back()->with('success', 'Brand delete successfull.');
  }
}
