<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductController extends Controller
{

  protected $productRepository;

  public function __construct(ProductRepositoryInterface $productRepository)
  {
    $this->productRepository = $productRepository;
  }


  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $products = $this->productRepository->getAll();
    return view('admin.product.index', compact('products'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $categories = Category::active()->get();
    return view('admin.product.create', compact('categories'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreProductRequest $request)
  {
    $this->productRepository->create($request->validated());
    return redirect()->back()->with('success', 'Product added successfull.');
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
    $product = $this->productRepository->getById($id);
    $categories = Category::active()->get();
    return view('admin.product.edit', compact('product', 'categories'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(StoreProductRequest $request, string $id)
  {
    $this->productRepository->update($id, $request->validated());
    return redirect()->back()->with('success', 'Product update successfull.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $this->productRepository->destroy($id);
    return redirect()->back()->with('success', 'Product delete successfull.');
  }
}
