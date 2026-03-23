<?php

namespace App\Service\Admin;

use App\Models\Category;

class CategoryService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function create($data)
    {
        return Category::create([
            'name' => $data['name'],
        ]);
    }

    public function update(Category $category, $data)
    {
        $category->update([
            'name' => $data['name'],
        ]);
    }
}
