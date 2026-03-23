<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryCreateRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Models\Category;
use App\Service\Admin\CategoryService;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $service;
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request)
    {
        $validated = $request->validated();

        try {
            $create = $this->service->create($validated);

            return redirect()->route('admin.categories.index')->with('status', 'Category created successfully.');
        } catch (Exception $e) {
            logger('Category Create Error: ' . $e);
            return redirect()->route('admin.categories.index')->with('status', 'Something went wrong. Please try again.');
        }
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
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $validated = $request->validated();

        try {
            $update = $this->service->update($category, $validated);

            return redirect()->route('admin.categories.index')->with('status', 'Category updated successfully.');
        } catch (Exception $e) {
            logger('Category Update Error: ' . $e);
            return redirect()->route('admin.categories.index')->with('status', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('status', 'Category deleted successfully.');
    }
}
