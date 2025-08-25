<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Total booking user ini
        $bookingsCount = $user->bookings()->count();

        // Booking terbaru user ini
        $latestBookings = $user->bookings()
            ->with('book')
            ->latest()
            ->take(5)
            ->get();

        // Total buku di sistem
        $booksCount = Book::count();

        // Total semua user
        $usersCount = User::count();

        return view('user.dashboard', compact(
            'user',
            'bookingsCount',
            'latestBookings',
            'booksCount',
            'usersCount'
        ));
    }
}
