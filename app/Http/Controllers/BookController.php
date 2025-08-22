<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Tampilkan daftar buku (untuk Admin & User).
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $books = Book::when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                             ->orWhere('author', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(5);

        if (Auth::user()->role === 'admin') {
            // Admin view → resources/views/books/index.blade.php
            return view('books.index', compact('books', 'search'));
        }

        // User view → resources/views/user/books/index.blade.php
        return view('user.books.index', compact('books', 'search'));
    }

    /**
     * Form tambah buku (khusus Admin).
     */
    public function create()
    {
        $this->authorizeAdmin();
        return view('books.create');
    }

    /**
     * Simpan buku baru (khusus Admin).
     */
    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'title'  => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'cover'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $book = new Book();
        $book->title  = $request->title;
        $book->author = $request->author;

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('covers', 'public');
            $book->cover = $path;
        }

        $book->save();

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    /**
     * Detail buku (bisa diakses siapa saja).
     */
    public function show(Book $book)
    {
        if (Auth::user()->role === 'admin') {
            return view('books.show', compact('book'));
        }
        return view('user.books.show', compact('book'));
    }

    /**
     * Form edit buku (khusus Admin).
     */
    public function edit(Book $book)
    {
        $this->authorizeAdmin();
        return view('books.edit', compact('book'));
    }

    /**
     * Update buku (khusus Admin).
     */
    public function update(Request $request, Book $book)
    {
        $this->authorizeAdmin();

        $request->validate([
            'title'  => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'cover'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $book->title  = $request->title;
        $book->author = $request->author;

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('covers', 'public');
            $book->cover = $path;
        }

        $book->save();

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    /**
     * Hapus buku (khusus Admin).
     */
    public function destroy(Book $book)
    {
        $this->authorizeAdmin();

        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }

    /**
     * Helper function: pastikan hanya admin yang bisa akses.
     */
    private function authorizeAdmin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
    }
}
