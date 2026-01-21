@extends('layouts.app')

@section('content')
    <!-- Header Section -->
    <div class="bg-blue-600 rounded-2xl p-8 mb-8 shadow-lg relative overflow-hidden text-white">


        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="text-3xl font-bold mb-2 flex items-center">
                    <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                    Daftar Buku
                </h2>
                <p class="text-blue-100 text-lg">Temukan dan pinjam buku favoritmu</p>
            </div>
            <a href="{{ route('user.bookings.index') }}"
                class="bg-white text-blue-600 px-6 py-3 rounded-xl font-bold shadow-md hover:bg-blue-50 transition transform hover:-translate-y-1 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                    </path>
                </svg>
                Peminjaman Saya
            </a>
        </div>


    </div>

    <!-- Search Section -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
        <form action="{{ route('user.books.index') }}" method="GET" class="relative">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" name="search" value="{{ $search ?? '' }}"
                    placeholder="Cari buku berdasarkan judul atau penulis..."
                    class="block w-full pl-12 pr-4 py-4 border border-gray-200 rounded-xl leading-5 bg-gray-50 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white text-lg transition-all">
                @if(request()->has('search') && request()->search != '')
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <a href="{{ route('user.books.index') }}" class="text-gray-400 hover:text-gray-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </a>
                    </div>
                @else
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition">
                            Cari
                        </button>
                    </div>
                @endif
            </div>
        </form>
    </div>

    <!-- Books Grid -->
    @if($books->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($books as $book)
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group flex flex-col h-full">
                    <!-- Cover Image -->
                    <div class="relative h-64 overflow-hidden bg-gray-100 flex items-center justify-center">
                        @if($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        @else
                            <div class="text-gray-400 text-center p-4">
                                <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                                <span class="text-sm">Tidak ada cover</span>
                            </div>
                        @endif

                        <!-- Overlay Gradient -->
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="mb-4 flex-1">
                            <h3 class="text-xl font-bold text-gray-900 leading-tight mb-2 line-clamp-2" title="{{ $book->title }}">
                                {{ $book->title }}
                            </h3>
                            <p class="text-gray-600 font-medium flex items-center mb-2">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                {{ $book->author }}
                            </p>
                            @if($book->description)
                                <p class="text-gray-500 text-sm line-clamp-3 leading-relaxed">
                                    {{ $book->description }}
                                </p>
                            @endif
                        </div>

                        <!-- Action -->
                        <div class="mt-auto pt-4 border-t border-gray-100">
                            <button disabled
                                class="w-full bg-gray-100 text-gray-500 font-medium py-3 px-4 rounded-xl cursor-not-allowed flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Hubungi Admin untuk Meminjam
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $books->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-20 bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-100 mb-6">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Buku Tidak Ditemukan</h3>
            <p class="text-gray-500 max-w-md mx-auto">
                Maaf, kami tidak dapat menemukan buku yang Anda cari. Coba gunakan kata kunci lain atau lihat daftar buku
                lainnya.
            </p>
            @if(request()->has('search') && request()->search != '')
                <a href="{{ route('user.books.index') }}"
                    class="inline-block mt-6 px-6 py-2 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition">
                    Bersihkan Pencarian
                </a>
            @endif
        </div>
    @endif
@endsection