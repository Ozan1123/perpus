@extends('layouts.app')

@section('content')
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-800 rounded-2xl p-8 mb-6 shadow-lg relative overflow-hidden">
        <div class="absolute top-0 right-0 w-24 h-24 bg-white bg-opacity-10 rounded-full transform translate-x-12 -translate-y-12"></div>
        <div class="absolute bottom-0 left-0 w-16 h-16 bg-white bg-opacity-5 rounded-full transform -translate-x-8 translate-y-8"></div>

        <div class="relative z-10 flex justify-between items-center text-white">
            <h2 class="text-2xl font-bold flex items-center">📚 Daftar Buku</h2>
            <a href="{{ route('user.bookings.index') }}"
                class="bg-white text-blue-600 bg-opacity-20 hover:bg-opacity-30 px-4 py-2 rounded-lg shadow text-sm font-medium transition">
                📖 Booking Saya
            </a>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="mb-6 flex justify-between items-center">
        <form action="{{ route('user.books.index') }}" method="GET" class="flex w-full max-w-md">
            <input type="text" name="search" value="{{ $search ?? '' }}"
                placeholder="Cari judul atau penulis..."
                class="px-4 py-2 w-full border border-purple-500 rounded-l-xl focus:ring-2 focus:ring-purple-500 focus:outline-none">
            <button type="submit"
                class="bg-purple-600 hover:bg-purple-700 text-white px-4 rounded-r-xl font-medium transition">
                🔍 Cari
            </button>
        </form>

        @if(request()->has('search') && request()->search != '')
            <a href="{{ route('user.books.index') }}" 
                class="ml-3 text-sm text-gray-600 hover:text-purple-600 underline">
                Reset
            </a>
        @endif
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Cover</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Penulis</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($books as $book)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-3 text-center">
                            @if($book->cover)
                                <img src="{{ asset('storage/' . $book->cover) }}"
                                     alt="Cover" class="w-14 h-18 object-cover mx-auto rounded shadow-sm">
                            @else
                                <span class="text-gray-400 italic">No cover</span>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-sm font-medium text-gray-900">{{ $book->title }}</td>
                        <td class="px-6 py-3 text-sm text-gray-600">{{ $book->author }}</td>
                        <td class="px-6 py-3 text-center">
                            <form action="{{ route('user.books.book', $book->id) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit"
                                    class="bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white px-4 py-1.5 rounded-lg text-sm font-medium shadow transition">
                                    📖 Pinjam
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-6 text-center text-gray-500">
                            Tidak ada buku ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $books->links() }}
    </div>
@endsection
