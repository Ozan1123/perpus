<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Booking;

class AdminController extends Controller
{
    public function index()
    {
        $booksCount    = Book::count();
        $usersCount    = User::count();
        $bookingsCount = Booking::count();

        // Ambil 5 booking terbaru
        $latestBookings = Booking::with('user', 'book')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'booksCount',
            'usersCount',
            'bookingsCount',
            'latestBookings'
        ));
    }
}
