<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil 5 booking terakhir milik user
        $latestBookings = Booking::with('book')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $booksCount = Book::count();

        return view('user.dashboard', compact('user', 'latestBookings', 'booksCount'));
    }
}
