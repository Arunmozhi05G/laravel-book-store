<?php

namespace App\Service;

use App\Models\Book;
use Illuminate\Support\Facades\Http;

class GoogleAPIService
{
    /**
     * Search books from Google Books API and return a collection of Book models.
     */
    public function searchBooks(string $query, int $limit = 8)
    {
        $apiBooks = collect();

        try {
            $params = [
                'q'          => $query,
                'maxResults' => $limit,
            ];
            if ($apiKey = env('GOOGLE_BOOK_API_KEY')) {
                $params['key'] = $apiKey;
            }

            $response = Http::timeout(5)->get('https://www.googleapis.com/books/v1/volumes', $params);

            if ($response->successful() && isset($response['items'])) {
                foreach ($response['items'] as $item) {
                    $vol = $item['volumeInfo'] ?? [];

                    if (empty($vol['title']) || empty($vol['imageLinks']['thumbnail'])) {
                        continue;
                    }

                    $apiBook = new Book();
                    $apiBook->incrementing = false; // Required to stop ID casting to integer 0
                    $apiBook->id = 'g-' . $item['id'];
                    $apiBook->title = $vol['title'];
                    $apiBook->author = implode(', ', $vol['authors'] ?? ['Unknown Author']);
                    $apiBook->price = $item['saleInfo']['retailPrice']['amount'] ?? random_int(200, 999);
                    $apiBook->image = $vol['imageLinks']['thumbnail'];
                    $apiBook->quantity = 10;
                    $apiBook->is_api = true;
                    $apiBook->category_name = $vol['categories'][0] ?? 'Tech / General';
                    $apiBook->setRelation('category', (object)['name' => $apiBook->category_name]);

                    $apiBooks->push($apiBook);
                }
            }
        } catch (\Exception $e) {
            logger('Google Books API Error: ' . $e->getMessage());
        }

        return $apiBooks;
    }

    /**
     * Get a single book from Google Books API by its Google ID.
     */
    public function getBook(string $googleId)
    {
        $params = [];
        if ($apiKey = env('GOOGLE_BOOK_API_KEY')) {
            $params['key'] = $apiKey;
        }

        $response = Http::timeout(5)->get("https://www.googleapis.com/books/v1/volumes/{$googleId}", $params);

        if ($response->failed()) {
            return null;
        }

        $apiData = $response->json();
        $volumeInfo = $apiData['volumeInfo'] ?? [];

        $book = new Book();
        $book->incrementing = false; // Required to stop ID casting to integer 0
        $book->id = 'g-' . $googleId;
        $book->title = $volumeInfo['title'] ?? 'Unknown Title';
        $book->author = implode(', ', $volumeInfo['authors'] ?? ['Unknown Author']);
        $book->description = $volumeInfo['description'] ?? 'No description available.';
        $book->price = $apiData['saleInfo']['retailPrice']['amount'] ?? 100;
        $book->quantity = 10;
        $book->image = $volumeInfo['imageLinks']['thumbnail'] ?? null;
        $book->is_api = true;
        // Fake category relationship
        $book->category_name = $volumeInfo['categories'][0] ?? 'General';

        return $book;
    }
}
