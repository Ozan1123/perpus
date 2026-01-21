@extends('layouts.app')

@section('content')
    <!-- Header Section -->
    <div class="bg-blue-600 rounded-2xl p-8 mb-8 shadow-lg relative overflow-hidden text-white">


        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="text-3xl font-bold mb-2 flex items-center">
                    <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                    Manajemen Peminjaman
                </h2>
                <p class="text-blue-100 text-lg">Kelola status dan riwayat peminjaman buku</p>
            </div>

            <!-- Stats -->
            <div class="flex flex-wrap justify-center gap-4">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl px-6 py-3 border border-white/20 min-w-[140px]">
                    <div class="text-sm text-blue-50 font-medium mb-1">Total Peminjaman</div>
                    <div class="text-2xl font-bold">{{ $bookings->count() }}</div>
                </div>
                <div
                    class="bg-orange-500/20 backdrop-blur-sm rounded-xl px-6 py-3 border border-orange-400/30 min-w-[140px]">
                    <div class="text-sm text-orange-50 font-medium mb-1">Hari Ini</div>
                    <div class="text-2xl font-bold text-orange-100">
                        {{ $bookings->where('booked_at', '>=', today())->count() }}
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- Search & Filter Bar -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">
            <!-- Search Form -->
            <form action="{{ route('admin.bookings.index') }}" method="GET" class="flex-1 max-w-lg">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari berdasarkan nama user atau judul buku..."
                        class="block w-full pl-10 pr-20 py-3 border border-gray-200 rounded-lg leading-5 bg-gray-50 placeholder-gray-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2">
                        <button type="submit"
                            class="bg-blue-100 text-blue-600 hover:bg-blue-200 px-3 py-1 rounded-md text-sm font-medium transition-colors">
                            Cari
                        </button>
                    </div>
                </div>
            </form>

            <!-- Filter & Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3">
                <!-- Add Booking Button -->
                <a href="{{ route('admin.bookings.create') }}"
                    class="inline-flex items-center justify-center px-4 py-3 bg-blue-600 border border-transparent rounded-lg font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Peminjaman
                </a>

                <!-- Export Button -->
                <a href="{{ route('admin.bookings.export') }}"
                    class="inline-flex items-center justify-center px-4 py-3 bg-green-600 border border-transparent rounded-lg font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Export Excel
                </a>

                <!-- Filter Dropdown -->
                <div class="relative">
                    <form method="GET" action="{{ route('admin.bookings.index') }}">
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        <select name="filter" onchange="this.form.submit()"
                            class="appearance-none bg-gray-50 border border-gray-200 rounded-lg px-4 py-3 pr-8 text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500 cursor-pointer min-w-[180px]">
                            <option value="">Semua Peminjaman</option>
                            <option value="today" {{ request('filter') == 'today' ? 'selected' : '' }}>Hari Ini</option>
                            <option value="week" {{ request('filter') == 'week' ? 'selected' : '' }}>Minggu Ini</option>
                            <option value="month" {{ request('filter') == 'month' ? 'selected' : '' }}>Bulan Ini</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Reset Search -->
        @if(request()->has('search') && request()->search != '')
            <div class="mt-4 pt-4 border-t border-gray-100">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">
                        Menampilkan hasil pencarian untuk: <strong class="text-gray-900">"{{ request()->search }}"</strong>
                    </span>
                    <a href="{{ route('admin.bookings.index') }}"
                        class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 font-medium group">
                        <svg class="w-4 h-4 mr-1 group-hover:rotate-180 transition-transform duration-300" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        Reset Pencarian
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Bookings Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        @if($bookings->count() > 0)
            <!-- Desktop Table View -->
            <div class="hidden lg:block">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span>User</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                        </path>
                                    </svg>
                                    <span>Buku</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3a4 4 0 118 0v4m-8 0h8a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2v-6a2 2 0 012-2z">
                                        </path>
                                    </svg>
                                    <span>Tanggal Peminjaman</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Status</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($bookings as $booking)
                            <tr class="hover:bg-blue-50 transition-colors duration-150">
                                <!-- User Info -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $booking->user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $booking->user->email }}</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Book Info -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if($booking->book->cover)
                                            <img src="{{ asset('storage/' . $booking->book->cover) }}"
                                                alt="Cover {{ $booking->book->title }}"
                                                class="w-12 h-16 object-cover rounded-lg shadow-sm mr-4">
                                        @else
                                            <div class="w-12 h-16 bg-gray-200 rounded-lg flex items-center justify-center mr-4">
                                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $booking->book->title }}</div>
                                            <div class="text-xs text-gray-500">{{ $booking->book->author }}</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Date -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $booking->booked_at->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $booking->booked_at->format('H:i') }} WIB</div>
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($booking->returned_at)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                            Dikembalikan
                                        </span>
                                        <div class="text-xs text-gray-500 mt-1">{{ $booking->returned_at->format('d M Y') }}</div>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                            Dipinjam
                                        </span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center space-x-2">
                                        @if(!$booking->returned_at)
                                            <!-- Return Button -->
                                            <form action="{{ route('admin.bookings.return', $booking->id) }}" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Tandai buku ini sudah dikembalikan? Stok akan bertambah.');">
                                                @csrf
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-150">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    Kembalikan
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus peminjaman ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-150">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="lg:hidden">
                <div class="p-4 space-y-4">
                    @foreach($bookings as $booking)
                        <div
                            class="bg-gray-50 rounded-lg p-4 hover:bg-blue-50 transition-colors duration-150 border border-gray-100 shadow-sm">
                            <div class="flex items-start space-x-4">
                                <!-- Book Cover -->
                                <div class="flex-shrink-0">
                                    @if($booking->book->cover)
                                        <img src="{{ asset('storage/' . $booking->book->cover) }}"
                                            alt="Cover {{ $booking->book->title }}" class="w-12 h-16 object-cover rounded-lg shadow-sm">
                                    @else
                                        <div class="w-12 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-start mb-2">
                                        <div class="flex-1">
                                            <h3 class="text-sm font-bold text-gray-900 truncate">{{ $booking->book->title }}</h3>
                                            <p class="text-xs text-gray-500">oleh {{ $booking->book->author }}</p>
                                        </div>
                                        <span
                                            class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Dipinjam
                                        </span>
                                    </div>

                                    <!-- User Info -->
                                    <div class="flex items-center space-x-2 mb-2">
                                        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span class="text-xs text-gray-600 font-medium">{{ $booking->user->name }}</span>
                                    </div>

                                    <!-- Date -->
                                    <div class="flex items-center space-x-2 mb-3">
                                        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3a4 4 0 118 0v4m-8 0h8a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2v-6a2 2 0 012-2z">
                                            </path>
                                        </svg>
                                        <span class="text-xs text-gray-500">{{ $booking->booked_at->format('d M Y H:i') }}</span>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex space-x-2">
                                        <button onclick="showBookingDetail({{ json_encode($booking) }})"
                                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 border border-blue-200 transition-colors">
                                            Detail
                                        </button>
                                        <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus peminjaman ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 text-xs font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100 border border-red-200 transition-colors">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-blue-50 mb-6">
                    <svg class="h-12 w-12 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">
                    @if(request()->has('search') && request()->search != '')
                        Peminjaman Tidak Ditemukan
                    @else
                        Belum Ada Peminjaman
                    @endif
                </h3>
                <p class="text-gray-500 mb-8 max-w-md mx-auto">
                    @if(request()->has('search') && request()->search != '')
                        Tidak ada data peminjaman yang cocok dengan "{{ request()->search }}". Silakan coba kata kunci lain.
                    @else
                        Saat ini belum ada data peminjaman buku yang tercatat dalam sistem.
                    @endif
                </p>
                <a href="{{ route('admin.books.index') }}"
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-lg shadow-blue-600/30 transition-all hover:-translate-y-1">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                    Kembali ke Daftar Buku
                </a>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    @if($bookings->hasPages())
        <div class="mt-6 bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1 flex justify-between sm:hidden">
                    @if ($bookings->onFirstPage())
                        <span
                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-gray-100 border border-gray-300 cursor-default leading-5 rounded-md">
                            Sebelumnya
                        </span>
                    @else
                        <a href="{{ $bookings->previousPageUrl() }}"
                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                            Sebelumnya
                        </a>
                    @endif

                    @if ($bookings->hasMorePages())
                        <a href="{{ $bookings->nextPageUrl() }}"
                            class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                            Selanjutnya
                        </a>
                    @else
                        <span
                            class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-gray-100 border border-gray-300 cursor-default leading-5 rounded-md">
                            Selanjutnya
                        </span>
                    @endif
                </div>

                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Menampilkan <span class="font-medium">{{ $bookings->firstItem() }}</span> sampai <span
                                class="font-medium">{{ $bookings->lastItem() }}</span> dari <span
                                class="font-medium">{{ $bookings->total() }}</span> hasil
                        </p>
                    </div>
                    <div>
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Booking Detail Modal -->
    <div id="bookingModal"
        class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50 transition-opacity duration-300">
        <div
            class="relative top-20 mx-auto p-0 border-0 w-full max-w-md shadow-2xl rounded-2xl bg-white transform transition-all duration-300 scale-95 opacity-0">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <h3 class="text-xl font-bold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Detail Peminjaman
                </h3>
                <button onclick="closeBookingModal()"
                    class="text-gray-400 hover:text-gray-600 transition duration-150 p-1 rounded-full hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="p-6">
                <div id="modalContent" class="space-y-6">
                    <!-- Content will be dynamically inserted here -->
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex items-center justify-end p-6 border-t border-gray-100 bg-gray-50 rounded-b-2xl">
                <button onclick="closeBookingModal()"
                    class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-lg shadow-blue-600/20 transition-all hover:-translate-y-0.5">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- JavaScript for interactions and animations -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Add fade-in animation to booking cards/rows
            const bookingElements = document.querySelectorAll('tbody tr, .bg-gray-50');
            bookingElements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(10px)';

                setTimeout(() => {
                    el.style.transition = 'all 0.4s ease';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 50);
            });

            // Enhanced search focus
            const searchInput = document.querySelector('input[name="search"]');
            if (searchInput) {
                searchInput.addEventListener('focus', function () {
                    this.parentElement.classList.add('ring-2', 'ring-blue-500');
                });
                searchInput.addEventListener('blur', function () {
                    this.parentElement.classList.remove('ring-2', 'ring-blue-500');
                });
            }

            // Auto-refresh every 30 seconds to show new bookings
            setInterval(function () {
                // Only refresh if no search is active
                if (!window.location.search.includes('search=')) {
                    const refreshIndicator = document.createElement('div');
                    refreshIndicator.className = 'fixed top-4 right-4 bg-blue-100 text-blue-800 px-4 py-2 rounded-lg text-sm z-50 shadow-md font-medium flex items-center gap-2 transition-all duration-300 transform translate-y-0 opacity-100';
                    refreshIndicator.innerHTML = `
                                        <svg class="animate-spin w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                        <span>Memperbarui data...</span>
                                    `;
                    document.body.appendChild(refreshIndicator);

                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                }
            }, 30000); // 30 seconds
        });

        // Show booking detail modal
        function showBookingDetail(booking) {
            const modal = document.getElementById('bookingModal');
            const modalPanel = modal.querySelector('.relative');
            const modalContent = document.getElementById('modalContent');

            const bookingDate = new Date(booking.booked_at);
            const formattedDate = bookingDate.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            const formattedTime = bookingDate.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });

            modalContent.innerHTML = `
                                <!-- User Information -->
                                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                                    <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                        <div class="bg-white p-1.5 rounded-lg shadow-sm mr-3">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        Informasi Peminjam
                                    </h4>
                                    <div class="space-y-2 ml-11">
                                        <div class="flex flex-col">
                                            <span class="text-xs text-gray-500 uppercase tracking-wide">Nama</span>
                                            <span class="text-sm font-medium text-gray-900">${booking.user.name}</span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-xs text-gray-500 uppercase tracking-wide">Email</span>
                                            <span class="text-sm font-medium text-gray-900">${booking.user.email}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Book Information -->
                                <div class="bg-blue-50/50 rounded-xl p-4 border border-blue-100">
                                    <h4 class="font-bold text-blue-900 mb-3 flex items-center">
                                        <div class="bg-blue-100 p-1.5 rounded-lg mr-3">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            </svg>
                                        </div>
                                        Informasi Buku
                                    </h4>
                                    <div class="space-y-2 ml-11">
                                        <div class="flex flex-col">
                                            <span class="text-xs text-blue-600/70 uppercase tracking-wide">Judul</span>
                                            <span class="text-sm font-medium text-blue-900">${booking.book.title}</span>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-xs text-blue-600/70 uppercase tracking-wide">Penulis</span>
                                            <span class="text-sm font-medium text-blue-900">${booking.book.author}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Booking Information -->
                                <div class="bg-white rounded-xl p-4 border-l-4 border-blue-500 shadow-sm">
                                    <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                        <svg class="w-5 h-5 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-8 0h8a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2v-6a2 2 0 012-2z"></path>
                                        </svg>
                                        Informasi Peminjaman
                                    </h4>
                                    <div class="grid grid-cols-2 gap-4 ml-8">
                                        <div>
                                            <span class="text-xs text-gray-500 block">Tanggal</span>
                                            <span class="text-sm font-medium text-gray-900">${formattedDate}</span>
                                        </div>
                                        <div>
                                            <span class="text-xs text-gray-500 block">Waktu</span>
                                            <span class="text-sm font-medium text-gray-900">${formattedTime} WIB</span>
                                        </div>
                                        <div class="col-span-2 mt-2">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 border border-blue-200">
                                                <span class="w-2 h-2 rounded-full bg-blue-500 mr-2"></span>
                                                Status: Dipinjam
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            `;

            // Show modal with animation
            modal.classList.remove('hidden');
            // Trigger reflow
            void modal.offsetWidth;

            modalPanel.style.transform = 'scale(1)';
            modalPanel.style.opacity = '1';
        }

        // Close booking detail modal
        function closeBookingModal() {
            const modal = document.getElementById('bookingModal');
            const modalPanel = modal.querySelector('.relative');

            modalPanel.style.transform = 'scale(0.95)';
            modalPanel.style.opacity = '0';

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // Close modal when clicking outside
        document.getElementById('bookingModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeBookingModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeBookingModal();
            }
        });
    </script>
@endsection
