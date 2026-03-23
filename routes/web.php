<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Site\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/books', [HomeController::class, 'books'])->name('books.list');
Route::get('/books/{id}', [ProductController::class, 'show'])->name('books.show');

Route::group(['middleware' => 'guest'], function () {

    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

    Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', [AdminHomeController::class, 'index'])->name('dashboard');
    Route::get('users', [AdminHomeController::class, 'users'])->name('users.index');

    Route::controller(CategoryController::class)->prefix('categories')->as('categories.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{category}', 'edit')->name('edit');
        Route::post('/update/{category}', 'update')->name('update');
        Route::get('/destroy/{category}', 'destroy')->name('destroy');
    });

    Route::controller(BookController::class)->prefix('books')->as('books.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{book}', 'edit')->name('edit');
        Route::post('/update/{book}', 'update')->name('update');
        Route::get('/destroy/{book}', 'destroy')->name('destroy');
    });
});

Route::view('/test-login', 'login');
