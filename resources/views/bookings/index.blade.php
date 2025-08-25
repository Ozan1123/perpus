@extends('layouts.app')

@section('content')
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-purple-600 to-purple-800 rounded-2xl p-8 mb-8 shadow-lg relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-white bg-opacity-10 rounded-full transform translate-x-16 -translate-y-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white bg-opacity-5 rounded-full transform -translate-x-12 translate-y-12"></div>
        
        <div class="relative z-10">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center text-white">
                <div>
                    <h2 class="text-3xl font-bold mb-2 flex items-center">
                        <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Manajemen Peminjaman
                    </h2>
                    <p class="text-purple-100 text-lg">Kelola daftar peminjaman buku perpustakaan</p>
                </div>
                <!-- Stats in header -->
                <div class="mt-4 md:mt-0 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-white bg-opacity-20 rounded-xl px-6 py-4">
                        <div class="text-sm text-purple-600 mb-1">Total Peminjaman</div>
                        <div class="text-3xl text-purple-600 font-bold">{{ $bookings->count() }}</div>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-xl px-6 py-4">
                        <div class="text-sm text-purple-600 mb-1">Hari Ini</div>
                        <div class="text-3xl text-purple-600 font-bold">{{ $bookings->where('booked_at', '>=', today())->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Breadcrumb & Action Bar -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.books.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Manajemen Buku
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Daftar Peminjaman</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Search & Filter Bar -->
        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">
            <!-- Search Form -->
            <form action="{{ route('admin.bookings.index') }}" method="GET" class="flex-1 max-w-lg">
                <div class="flex">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Cari berdasarkan nama user atau judul buku..."
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-l-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>
                    <button type="submit" class="inline-flex items-center px-4 py-3 border border-transparent text-sm font-medium rounded-r-lg text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Cari
                    </button>
                </div>
            </form>

            <!-- Filter & Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3">
                <!-- Filter Dropdown -->
                <div class="relative">
                    <select name="filter" 
                            onchange="window.location.href = + '{{ route('admin.bookings.index') }}?filter=' + this.value"
                            class="appearance-none bg-white border border-gray-300 rounded-lg px-4 py-3 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <option value="">Semua Peminjaman</option>
                        <option value="today" {{ request('filter') == 'today' ? 'selected' : '' }}>Hari Ini</option>
                        <option value="week" {{ request('filter') == 'week' ? 'selected' : '' }}>Minggu Ini</option>
                        <option value="month" {{ request('filter') == 'month' ? 'selected' : '' }}>Bulan Ini</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                </div>

                <!-- Export Button -->
                <!-- <a href="{{ route('admin.bookings.export') }}" 
                   class="inline-flex items-center justify-center px-4 py-3 border border-gray-300 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Export
                </a> -->
            </div>
        </div>

        <!-- Reset Search -->
        @if(request()->has('search') && request()->search != '')
            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">
                        Menampilkan hasil pencarian untuk: <strong>"{{ request()->search }}"</strong>
                    </span>
                    <a href="{{ route('admin.bookings.index') }}" 
                       class="inline-flex items-center text-sm text-purple-600 hover:text-purple-800 font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span>User</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                    <span>Buku</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-8 0h8a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2v-6a2 2 0 012-2z"></path>
                                    </svg>
                                    <span>Tanggal Peminjaman</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Status</span>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($bookings as $booking)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <!-- User Info -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
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
                                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $booking->book->title }}</div>
                                            <div class="text-sm text-gray-500">{{ $booking->book->author }}</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Date -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $booking->booked_at->format('d M Y') }}</div>
                                    <div class="text-sm text-gray-500">{{ $booking->booked_at->format('H:i') }} WIB</div>
                                    <div class="text-xs text-gray-400">{{ $booking->booked_at->diffForHumans() }}</div>
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                        </svg>
                                        Dipinjam
                                    </span>
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center space-x-2">
                                        <!-- View Details Button -->
                                        <button onclick="showBookingDetail({{ json_encode($booking) }})"
                                               class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Detail
                                        </button>

                                        <!-- Delete Button -->
                                        <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" class="inline-block"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus peminjaman ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-150">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
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
                        <div class="bg-gray-50 rounded-lg p-4 hover:bg-gray-100 transition-colors duration-150">
                            <div class="flex items-start space-x-4">
                                <!-- Book Cover -->
                                <div class="flex-shrink-0">
                                    @if($booking->book->cover)
                                        <img src="{{ asset('storage/' . $booking->book->cover) }}"
                                             alt="Cover {{ $booking->book->title }}" 
                                             class="w-12 h-16 object-cover rounded-lg shadow-sm">
                                    @else
                                        <div class="w-12 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-start mb-2">
                                        <div class="flex-1">
                                            <h3 class="text-sm font-semibold text-gray-900 truncate">{{ $booking->book->title }}</h3>
                                            <p class="text-sm text-gray-600">oleh {{ $booking->book->author }}</p>
                                        </div>
                                        <span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Dipinjam
                                        </span>
                                    </div>

                                    <!-- User Info -->
                                    <div class="flex items-center space-x-2 mb-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-600">{{ $booking->user->name }}</span>
                                    </div>

                                    <!-- Date -->
                                    <div class="flex items-center space-x-2 mb-3">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-8 0h8a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2v-6a2 2 0 012-2z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-600">{{ $booking->booked_at->format('d M Y H:i') }}</span>
                                        <span class="text-xs text-gray-400">{{ $booking->booked_at->diffForHumans() }}</span>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex space-x-2">
                                        <button onclick="showBookingDetail({{ json_encode($booking) }})"
                                               class="inline-flex items-center px-3 py-1 text-xs font-medium rounded text-blue-700 bg-blue-100 hover:bg-blue-200">
                                            Detail
                                        </button>
                                        <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" class="inline-block"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus peminjaman ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center px-3 py-1 text-xs font-medium rounded text-red-700 bg-red-100 hover:bg-red-200">
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
                <svg class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <h3 class="text-xl font-medium text-gray-900 mb-2">
                    @if(request()->has('search') && request()->search != '')
                        Peminjaman Tidak Ditemukan
                    @else
                        Belum Ada Peminjaman
                    @endif
                </h3>
                <p class="text-gray-500 mb-6">
                    @if(request()->has('search') && request()->search != '')
                        Tidak ada peminjaman yang sesuai dengan kata kunci pencarian Anda.
                    @else
                        Belum ada yang meminjam buku dari perpustakaan.
                    @endif
                </p>
                <a href="{{ route('admin.books.index') }}"
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
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
                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-gray-100 border border-gray-300 cursor-default leading-5 rounded-md">
                            Sebelumnya
                        </span>
                    @else
                        <a href="{{ $bookings->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                            Sebelumnya
                        </a>
                    @endif

                    @if ($bookings->hasMorePages())
                        <a href="{{ $bookings->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                            Selanjutnya
                        </a>
                    @else
                        <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-gray-100 border border-gray-300 cursor-default leading-5 rounded-md">
                            Selanjutnya
                        </span>
                    @endif
                </div>

                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Menampilkan <span class="font-medium">{{ $bookings->firstItem() }}</span> sampai <span class="font-medium">{{ $bookings->lastItem() }}</span> dari <span class="font-medium">{{ $bookings->total() }}</span> hasil
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
    <div id="bookingModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-xl bg-white">
            <!-- Modal Header -->
            <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Detail Peminjaman
                </h3>
                <button onclick="closeBookingModal()" class="text-gray-400 hover:text-gray-600 transition duration-150">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Content -->
            <div class="py-4">
                <div id="modalContent" class="space-y-4">
                    <!-- Content will be dynamically inserted here -->
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex items-center justify-end pt-4 border-t border-gray-200 space-x-2">
                <button onclick="closeBookingModal()" 
                        class="px-4 py-2 bg-gray-300 text-gray-800 text-sm rounded-lg hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-150">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- JavaScript for interactions and animations -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add fade-in animation to booking cards/rows
            const bookingElements = document.querySelectorAll('tbody tr, .bg-gray-50');
            bookingElements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(10px)';
                
                setTimeout(() => {
                    el.style.transition = 'all 0.4s ease';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Enhanced search focus
            const searchInput = document.querySelector('input[name="search"]');
            if (searchInput) {
                searchInput.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-purple-500');
                });
                searchInput.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-purple-500');
                });
            }

            // Auto-refresh every 30 seconds to show new bookings
            setInterval(function() {
                // Only refresh if no search is active
                if (!window.location.search.includes('search=')) {
                    const refreshIndicator = document.createElement('div');
                    refreshIndicator.className = 'fixed top-4 right-4 bg-purple-100 text-purple-800 px-3 py-2 rounded-lg text-sm z-50';
                    refreshIndicator.innerHTML = `
                        <div class="flex items-center">
                            <svg class="animate-spin w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Memperbarui data...
                        </div>
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
                <div class="bg-purple-50 rounded-lg p-4">
                    <h4 class="font-semibold text-purple-900 mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Informasi Peminjam
                    </h4>
                    <div class="space-y-1">
                        <p class="text-sm"><span class="font-medium">Nama:</span> ${booking.user.name}</p>
                        <p class="text-sm"><span class="font-medium">Email:</span> ${booking.user.email}</p>
                    </div>
                </div>

                <!-- Book Information -->
                <div class="bg-blue-50 rounded-lg p-4">
                    <h4 class="font-semibold text-blue-900 mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Informasi Buku
                    </h4>
                    <div class="space-y-1">
                        <p class="text-sm"><span class="font-medium">Judul:</span> ${booking.book.title}</p>
                        <p class="text-sm"><span class="font-medium">Penulis:</span> ${booking.book.author}</p>
                        ${booking.book.description ? `<p class="text-sm"><span class="font-medium">Deskripsi:</span> ${booking.book.description}</p>` : ''}
                    </div>
                </div>

                <!-- Booking Information -->
                <div class="bg-yellow-50 rounded-lg p-4">
                    <h4 class="font-semibold text-yellow-900 mb-2 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-8 0h8a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2v-6a2 2 0 012-2z"></path>
                        </svg>
                        Informasi Peminjaman
                    </h4>
                    <div class="space-y-1">
                        <p class="text-sm"><span class="font-medium">Tanggal:</span> ${formattedDate}</p>
                        <p class="text-sm"><span class="font-medium">Waktu:</span> ${formattedTime} WIB</p>
                        <p class="text-sm"><span class="font-medium">ID Peminjaman:</span> #${booking.id}</p>
                        <div class="mt-2">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                                Status: Dipinjam
                            </span>
                        </div>
                    </div>
                </div>
            `;

            // Show modal with animation
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.querySelector('.relative').style.transform = 'scale(1)';
                modal.querySelector('.relative').style.opacity = '1';
            }, 10);
        }

        // Close booking detail modal
        function closeBookingModal() {
            const modal = document.getElementById('bookingModal');
            modal.querySelector('.relative').style.transform = 'scale(0.95)';
            modal.querySelector('.relative').style.opacity = '0';
            
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 150);
        }

        // Close modal when clicking outside
        document.getElementById('bookingModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeBookingModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeBookingModal();
            }
        });

        // Initialize modal animations
        document.getElementById('bookingModal').querySelector('.relative').style.transform = 'scale(0.95)';
        document.getElementById('bookingModal').querySelector('.relative').style.opacity = '0';
        document.getElementById('bookingModal').querySelector('.relative').style.transition = 'all 0.15s ease-out';
    </script>
@endsection