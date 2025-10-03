<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Admin: lihat semua booking + search + filter
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'book'])->latest();

        // 🔍 Search (nama user atau judul buku)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            })->orWhereHas('book', function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // 📅 Filter (hari ini, minggu ini, bulan ini)
        if ($request->filter == 'today') {
            $query->whereDate('booked_at', today());
        } elseif ($request->filter == 'week') {
            $query->whereBetween('booked_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($request->filter == 'month') {
            $query->whereMonth('booked_at', now()->month)
                  ->whereYear('booked_at', now()->year);
        }

        $bookings = $query->paginate(10)->withQueryString();

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
