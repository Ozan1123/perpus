<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $booksCount    = Book::count();
        $usersCount    = User::count();
        $bookingsCount = Booking::count();

        $latestBookings = Booking::with('user', 'book')
            ->latest()
            ->take(5)
            ->get();

        // FIX: gunakan view admin.dashboard
        return view('dashboard', [
            'user'           => Auth::user(),
            'booksCount'     => $booksCount,
            'usersCount'     => $usersCount,
            'bookingsCount'  => $bookingsCount,
            'latestBookings' => $latestBookings,
        ]);
    }
}
