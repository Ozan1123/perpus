<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $books = Book::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(5);

        return view('books.index', compact('books', 'search'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn'   => 'nullable|string|max:255',
            'stock'  => 'required|integer|min:0',
            'description' => 'nullable|string',
            'cover'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $book = new Book();
        $book->title  = $request->title;
        $book->author = $request->author;
        $book->isbn   = $request->isbn;
        $book->stock  = $request->stock ?? 1;
        $book->description = $request->description;

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('covers', 'public');
            $book->cover = $path;
        }

        $book->save();

        return redirect()->route('admin.books.index')
            ->with('success', 'Book created successfully.');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title'  => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn'   => 'nullable|string|max:255',
            'stock'  => 'required|integer|min:0',
            'description' => 'nullable|string',
            'cover'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $book->title  = $request->title;
        $book->author = $request->author;
        $book->isbn   = $request->isbn;
        $book->stock  = $request->stock;
        $book->description = $request->description;

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('covers', 'public');
            $book->cover = $path;
        }

        $book->save();

        return redirect()->route('admin.books.index')
            ->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', 'Book deleted successfully.');
    }
}
