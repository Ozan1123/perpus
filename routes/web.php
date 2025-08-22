<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;

/*
|--------------------------------------------------------------------------
| Guest Routes (auth belum login)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // resources/views/dashboard.blade.php
    })->name('dashboard');

    // CRUD Buku hanya bisa Admin
    Route::resource('books', BookController::class);

    // Admin juga bisa lihat semua booking
    Route::get('/admin/bookings', [BookingController::class, 'index'])->name('admin.bookings.index');
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Dashboard user
    Route::get('/dashboard/user', function () {
        return view('user.dashboard'); // resources/views/user/dashboard.blade.php
    })->name('dashboard.user');

    // User lihat buku
    Route::get('/user/books', [BookController::class, 'index'])->name('user.books.index');

    // Booking
    Route::post('/books/{book}/book', [BookingController::class, 'store'])->name('books.book');
    Route::post('/bookings/{booking}/return', [BookingController::class, 'returnBook'])->name('bookings.return');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
