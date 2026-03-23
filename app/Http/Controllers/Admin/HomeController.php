<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'users' => User::whereNot('role', 1)->latest()->get(),
            'categories' => Category::latest()->get(),
            'books' => Book::latest()->get(),
        ]);
    }

    public function users()
    {
        return view('admin.users.index', [
            'users' => User::whereNot('role', 1)->latest()->get(),
        ]);
    }
}
