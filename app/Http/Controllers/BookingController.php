<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Book;
use App\Models\User;
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

    // Admin: Form Create Booking
    public function create()
    {
        $users = User::where('role', '!=', 'admin')->get(); // Get non-admin users
        $books = Book::where('stock', '>', 0)->get(); // Only books with stock
        return view('bookings.create', compact('users', 'books'));
    }

    // Admin: Store Booking
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stock < 1) {
            return back()->with('error', 'Stok buku habis.');
        }

        // Cek limit peminjaman (opsional, misalnya max 3 buku)
        $activeBookings = Booking::where('user_id', $request->user_id)->whereNull('returned_at')->count();
        if ($activeBookings >= 3) {
            return back()->with('error', 'User ini sudah meminjam 3 buku. Harus kembalikan dulu.');
        }

        Booking::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'booked_at' => now(),
            'status' => 'booked',
        ]);

        $book->decrement('stock');

        return redirect()->route('admin.bookings.index')->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    // Admin: Return Book
    public function returnBook(Booking $booking)
    {
        if ($booking->returned_at) {
            return back()->with('error', 'Buku ini sudah dikembalikan sebelumnya.');
        }

        $booking->update([
            'returned_at' => now(),
            'status' => 'returned',
        ]);

        $booking->book->increment('stock');

        return redirect()->route('admin.bookings.index')->with('success', 'Buku berhasil dikembalikan.');
    }

    // Admin: hapus booking
    public function destroy(Booking $booking)
    {
        // Jika hapus booking yang belum kembali, kembalikan stok?
        // Tergantung kebijakan. Asumsi destroy = data hilang (mistake), bukan return.
        // Tapi demi keamanan stok, jika belum kembali, increment stok dulu.
        if (!$booking->returned_at) {
            $booking->book->increment('stock');
        }

        $booking->delete();

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }

    // Export Excel (HTML Table)
    public function export(Request $request)
    {
        $bookings = Booking::with(['user', 'book'])->latest()->get();
        $filename = 'Laporan_Peminjaman_' . date('Ymd_His') . '.xls';

        return response()->streamDownload(function () use ($bookings) {
            // CSS Styles
            echo '<style>
                body { font-family: "Times New Roman", Times, serif; }
                table { border-collapse: collapse; width: 100%; margin-top: 20px; }
                th { background-color: #d9edf7; color: #000; border: 1px solid #000; padding: 10px; font-weight: bold; text-align: center; }
                td { border: 1px solid #000; padding: 8px; vertical-align: middle; }
                .header { text-align: center; margin-bottom: 30px; }
                .header h2 { margin: 0; font-size: 18pt; text-transform: uppercase; }
                .header p { margin: 2px 0; font-size: 12pt; }
                .meta { margin-bottom: 15px; font-size: 11pt; }
                .signatures { margin-top: 50px; width: 100%; display: flex; justify-content: space-between; }
                .signature-box { width: 30%; text-align: center; float: right; }
                .signature-box.left { float: left; }
                .spacer { height: 80px; }
            </style>';

            // KOP / Header Laporan
            echo '<div class="header">';
            echo '<h2>Laporan Peminjaman Buku</h2>';
            echo '<p>Perpustakaan Digital</p>';
            echo '<p>Periode Data: S/d ' . date('d F Y') . '</p>';
            echo '</div>';

            // Meta Info
            echo '<div class="meta">';
            echo '<strong>Dicetak Oleh:</strong> Admin<br>';
            echo '<strong>Tanggal Cetak:</strong> ' . date('d F Y H:i') . ' WIB<br>';
            echo '</div>';

            // Tabel Data
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th style="width: 40px;">No</th>';
            echo '<th style="width: 200px;">Nama Peminjam</th>';
            echo '<th style="width: 250px;">Judul Buku</th>';
            echo '<th style="width: 150px;">Penulis</th>';
            echo '<th style="width: 150px;">Tanggal Pinjam</th>';
            echo '<th style="width: 100px;">Status</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($bookings as $index => $booking) {
                echo '<tr>';
                echo '<td style="text-align: center;">' . ($index + 1) . '</td>';
                echo '<td>' . $booking->user->name . '</td>';
                echo '<td>' . $booking->book->title . '</td>';
                echo '<td>' . $booking->book->author . '</td>';
                echo '<td style="text-align: center;">' . $booking->booked_at->format('d/m/Y H:i') . '</td>';
                echo '<td style="text-align: center;">Dipinjam</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';

            // Signatures / Tanda Tangan
            echo '<br><br>';
            echo '<table style="width: 100%; border: none;">';
            echo '<tr>';
            // Kolom Kiri
            echo '<td style="border: none; text-align: center; width: 40%;">';
            echo 'Mengetahui,<br>Kepala Perpustakaan<br><br><br><br><br>';
            echo '<u>( .................................... )</u><br>';
            echo 'NIP. ...........................';
            echo '</td>';

            // Spacer
            echo '<td style="border: none; width: 20%;"></td>';

            // Kolom Kanan
            echo '<td style="border: none; text-align: center; width: 40%;">';
            echo 'Jakarta, ' . date('d F Y') . '<br>Petugas Admin<br><br><br><br><br>';
            echo '<u>( .................................... )</u>';
            echo '</td>';
            echo '</tr>';
            echo '</table>';
        }, $filename, [
            "Content-Type" => "application/vnd.ms-excel",
            "Content-Disposition" => "attachment; filename=\"$filename\""
        ]);
    }
}
