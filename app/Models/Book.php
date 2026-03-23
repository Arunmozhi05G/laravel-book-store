<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'image',
        'description',
        'price',
        'quantity',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
