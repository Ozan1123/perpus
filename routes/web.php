<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;        // Admin CRUD Books
use App\Http\Controllers\BookingController;     // Admin view Bookings
use App\Http\Controllers\UserController;

// Controller khusus user
use App\Http\Controllers\User\BookController as UserBookController;
use App\Http\Controllers\User\BookingController as UserBookingController;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => redirect()->route('login'));

// Auth Routes
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
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Resource asli (books)
    Route::resource('books', BookController::class);

    // Alias supaya nggak error Route [admin.books.*]
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

    // Booking (Admin only)
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');

    // Export bookings
    Route::get('/bookings/export', [BookingController::class, 'export'])->name('bookings.export');
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

    Route::get('/books', [UserBookController::class, 'index'])->name('books.index');
    Route::get('/books/{book}', [UserBookController::class, 'show'])->name('books.show');
    Route::post('/books/{book}/book', [UserBookController::class, 'book'])->name('books.book');

    Route::get('/bookings', [UserBookingController::class, 'index'])->name('bookings.index');
    Route::delete('/bookings/{booking}', [UserBookingController::class, 'destroy'])->name('bookings.destroy');
});
