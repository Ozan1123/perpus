<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // List semua booking
    public function index()
    {
        $bookings = Booking::with('book')->latest()->paginate(5);
        return view('bookings.index', compact('bookings'));
    }

    // Simpan booking baru
    public function store(Request $request, $bookId)
    {
        $book = Book::findOrFail($bookId);

        Booking::create([
            'book_id'   => $book->id,
            'user_id' => $request->user_name ?? 'Guest', // nanti bisa ganti pakai auth()->user()->name
            'booked_at  ' => now(),
        ]);

        return redirect()->route('bookings.index')->with('success', 'Book has been booked!');
    }

    // Batalkan booking
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking canceled.');
    }
}
