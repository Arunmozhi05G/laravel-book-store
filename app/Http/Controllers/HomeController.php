<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Service\GoogleAPIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $books      = Book::with('category')->latest()->take(8)->get();
        $categories = Category::withCount('books')->latest()->get();
        return view('site.home', compact('books', 'categories'));
    }
    public function books(Request $request)
    {
        $query = Book::with('category');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        match ($request->sort) {
            'price_asc'  => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'newest'     => $query->latest(),
            default      => $query->latest(),
        };

        $books      = $query->paginate(12)->withQueryString();
        $categories = Category::latest()->get();

        $searchQuery = $request->filled('search') ? $request->search : 'programming+laravel+php';
        $apiBooks = app(GoogleAPIService::class)->searchBooks($searchQuery, 8);
        

        return view('site.book-list', compact('books', 'categories', 'apiBooks'));
    }
}
