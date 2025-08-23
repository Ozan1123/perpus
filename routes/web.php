<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Guest Routes (belum login)
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => redirect()->route('login'));

// Login & Register
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isAdmin'])->group(function () {
    // Dashboard admin
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // CRUD Buku (khusus admin)
    Route::resource('books', BookController::class);

    // Admin lihat semua booking
    Route::get('/admin/bookings', [BookingController::class, 'index'])->name('admin.bookings.index');
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Dashboard user
    Route::get('/dashboard/user', [UserController::class, 'index'])->name('dashboard.user');

    // User hanya bisa lihat daftar buku (bukan CRUD)
    Route::get('/user/books', [BookController::class, 'index'])->name('user.books.index');

    // User bisa booking & return
    Route::post('/books/{book}/book', [BookingController::class, 'store'])->name('books.book');
    Route::post('/bookings/{booking}/return', [BookingController::class, 'returnBook'])->name('bookings.return');
});
