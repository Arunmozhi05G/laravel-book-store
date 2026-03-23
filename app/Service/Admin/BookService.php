<?php

namespace App\Service\Admin;

use App\Models\Book;

class BookService
{
    /**
     * Create a new book.
     */
    public function create(array $data): Book
    {
        if (isset($data['image'])) {
            $file     = $data['image'];
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/books'), $filename);
            $data['image'] = $filename;
        }

        return Book::create($data);
    }

    /**
     * Update an existing book.
     */
    public function update(array $data, Book $book): Book
    {
        if (isset($data['image'])) {
            // Delete old image
            if ($book->image) {
                $old = public_path('assets/books/' . $book->image);
                if (file_exists($old)) {
                    unlink($old);
                }
            }
            $file     = $data['image'];
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/books'), $filename);
            $data['image'] = $filename;
        }

        $book->update($data);

        return $book;
    }

    /**
     * Delete a book and its image.
     */
    public function delete(Book $book): void
    {
        if ($book->image) {
            $path = public_path('assets/books/' . $book->image);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $book->delete();
    }
}
