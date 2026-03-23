<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Service\GoogleAPIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    /**
     * Show the details of a specific book.
     * Supports both local DB books (id) and Google Books API (id starting with "g-").
     */
    public function show($id)
    {
        // Check if this is a Google Books API ID
        if (str_starts_with($id, 'g-')) {
            $googleId = substr($id, 2);
            $book = app(GoogleAPIService::class)->getBook($googleId);

            if (!$book) {
                abort(404, 'Book not found on Google Books.');
            }

            return view('site.book-details', compact('book'));

        } else {
            // Local Book
            $book = Book::with('category')->findOrFail($id);
            $book->is_api = false;
            $book->category_name = $book->category->name ?? 'General';
            return view('site.book-details', compact('book'));
        }
    }
}
