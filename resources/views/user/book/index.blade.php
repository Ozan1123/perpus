@extends('layouts.app')

@section('content')
    <!-- Container utama -->
    <div class="bg-purple-600 rounded-xl p-6">
        <div class="flex justify-between items-center mb-6 text-white">
            <h2 class="text-xl font-semibold">📚 Books List</h2>
        </div>

        {{-- Search Bar --}}
        <div class="mb-4 flex justify-between items-center">
            <form action="{{ route('books.index') }}" method="GET" class="flex">
                <input type="text" name="search" value="{{ $search ?? '' }}"
                    placeholder="Search by title or author..."
                    class="px-3 py-2 border border-blue-500 rounded-l-lg focus:ring-2 focus:ring-blue-500 w-64">
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 rounded-r-lg">
                    Search
                </button>
            </form>

            <div class="flex space-x-2">


                {{-- Link ke daftar booking --}}
                <a href="{{ route('bookings.index') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                    📖 Booking List
                </a>
            </div>
        </div>

        <!-- Card putih -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border text-left">Cover</th>
                        <th class="px-4 py-2 border text-left">Title</th>
                        <th class="px-4 py-2 border text-left">Author</th>
                        <th class="px-4 py-2 border text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border text-center">
                                @if($book->cover)
                                    <img src="{{ asset('storage/' . $book->cover) }}"
                                         alt="Cover" class="w-16 h-20 object-cover mx-auto rounded">
                                @else
                                    <span class="text-gray-400">No cover</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 border">{{ $book->title }}</td>
                            <td class="px-4 py-2 border">{{ $book->author }}</td>
                            <td class="px-4 py-2 border text-center space-x-1">
                                {{-- Tombol Edit --}}
                                <a href="{{ route('books.edit', $book) }}"
                                   class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">Edit</a>

                                {{-- Tombol Delete --}}
                                <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline-block"
                                      onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                        Delete
                                    </button>
                                </form>

                                {{-- Tombol Booking --}}
                                <form action="{{ route('books.book', $book->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit"
                                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
                                        Book
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-3 text-center text-gray-500">
                                No books found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if(request()->has('search') && request()->search != '')
                <a href="{{ route('books.index') }}" class="ml-3 text-sm text-gray-600 hover:underline">
                    Reset
                </a>
            @endif
        </div>
    </div>
@endsection
    