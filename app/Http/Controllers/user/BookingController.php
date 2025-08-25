<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // 📂 Tampilkan semua booking milik user
    public function index()
    {
        $bookings = Booking::with('book')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.bookings.index', compact('bookings'));
    }

    // ❌ Batalkan booking
    public function destroy(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403); // tidak boleh hapus booking orang lain
        }

        $booking->delete();

        return back()->with('success', 'Booking berhasil dibatalkan.');
    }
}
