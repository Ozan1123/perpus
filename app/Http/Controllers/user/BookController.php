<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        // Hard-guard: kalau admin nyasar ke route user, arahkan balik
        $u = Auth::user();
        $isAdmin = ($u->role ?? null) === 'admin' || (isset($u->is_admin) && (int)$u->is_admin === 1);
        if ($isAdmin) {
            return redirect()->route('admin.books.index');
        }

        $search = $request->input('search');

        $books = Book::when($search, function ($query, $search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(10);

        // View khusus user (pastikan file ini ADA)
        return view('user.books.index', compact('books', 'search'));
    }

    public function show(Book $book)
    {
        return view('user.books.show', compact('book'));
    }

    public function book(Request $request, Book $book)
    {
        // Peminjaman sekarang hanya lewat admin
        return redirect()
            ->route('user.books.index')
            ->with('error', 'Peminjaman buku hanya dapat dilakukan melalui Admin Perpustakaan. Silakan hubungi petugas.');
    }
}
