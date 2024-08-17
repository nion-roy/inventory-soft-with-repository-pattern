<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryController extends Controller
{
  protected $categoryRepository;

  public function __construct(CategoryRepositoryInterface $categoryRepository)
  {
    $this->categoryRepository = $categoryRepository;
  }


  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $categories = $this->categoryRepository->getAll();
    return view('admin.category.index', compact('categories'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('admin.category.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreCategoryRequest $request)
  {
    $this->categoryRepository->create($request->validated());
    return redirect()->back()->with('success', 'Category added successfull.');
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
    $category = $this->categoryRepository->findById($id);
    return view('admin.category.edit', compact('category'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(StoreCategoryRequest $request, string $id)
  {
    $this->categoryRepository->update($id, $request->validated());
    return redirect()->back()->with('success', 'Category update successfull.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $this->categoryRepository->destroy($id);
    return redirect()->back()->with('success', 'Category delete successfull.');
  }
}
