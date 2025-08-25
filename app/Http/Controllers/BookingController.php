<?php

namespace App\Http\Controllers;

use App\Models\Booking;

class BookingController extends Controller
{
    // Admin: lihat semua booking
    public function index()
    {
        $bookings = Booking::with(['user', 'book'])
            ->latest()
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    // Admin: hapus booking
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('admin.bookings.index')
                         ->with('success', 'Booking deleted successfully.');
    }
}
