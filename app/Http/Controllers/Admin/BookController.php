<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookCreateRequest;
use App\Http\Requests\Admin\BookUpdateRequest;
use App\Models\Book;
use App\Models\Category;
use App\Service\Admin\BookService;
use Exception;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $service;
    public function __construct(BookService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('category')->latest()->get();
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('admin.books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookCreateRequest $request)
    {
        $validated = $request->validated();

        try {
            if (isset($validated['image']) && $validated['image']->getSize() > 2 * 1024 * 1024) {
                return redirect()->back()->withInput()->with('status', 'Image size must not exceed 2MB.');
            }

            $this->service->create($validated);

            return redirect()->route('admin.books.index')->with('status', 'Book created successfully.');
        } catch (Exception $e) {
            logger('Book Create Error: ' . $e);
            return redirect()->back()->withInput()->with('status', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $categories = Category::latest()->get();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookUpdateRequest $request, Book $book)
    {
        $validated = $request->validated();

        try {
            $this->service->update($validated, $book);

            return redirect()->route('admin.books.index')->with('status', 'Book updated successfully.');
        } catch (Exception $e) {
            logger('Book Update Error: ' . $e);
            return redirect()->back()->withInput()->with('status', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        try {
            $this->service->delete($book);

            return redirect()->route('admin.books.index')->with('status', 'Book deleted successfully.');
        } catch (Exception $e) {
            logger('Book Delete Error: ' . $e);
            return redirect()->route('admin.books.index')->with('status', 'Something went wrong. Please try again.');
        }
    }
}
