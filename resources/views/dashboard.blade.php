@extends('layouts.app')

@section('content')
    <!-- Welcome Header -->
    <div class="bg-blue-600 rounded-2xl p-8 mb-8 shadow-lg text-white relative overflow-hidden">


        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center">
            <div>
                <h2 class="text-3xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name ?? 'Administrator' }}</h2>
                <p class="text-blue-100 text-lg">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
            </div>
            <div class="mt-4 md:mt-0 bg-blue-700 bg-opacity-50 px-6 py-3 rounded-xl backdrop-blur-sm border border-blue-500">
                <span id="current-time" class="text-2xl font-mono font-bold tracking-wider"></span>
            </div>
        </div>

    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
        <!-- Total Books -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-blue-50 p-3 rounded-xl group-hover:bg-blue-100 transition-colors">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-400 uppercase tracking-wider">Total Buku</span>
            </div>
            <div class="flex items-end justify-between">
                <div>
                    <h3 class="text-4xl font-bold text-gray-800">{{ number_format($booksCount) }}</h3>
                    <p class="text-sm text-green-600 mt-1 flex items-center font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        Tersedia
                    </p>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-green-50 p-3 rounded-xl group-hover:bg-green-100 transition-colors">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-400 uppercase tracking-wider">Anggota</span>
            </div>
            <div class="flex items-end justify-between">
                <div>
                    <h3 class="text-4xl font-bold text-gray-800">{{ number_format($usersCount) }}</h3>
                    <p class="text-sm text-green-600 mt-1 flex items-center font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        Aktif
                    </p>
                </div>
            </div>
        </div>

        <!-- Total Bookings -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-orange-50 p-3 rounded-xl group-hover:bg-orange-100 transition-colors">
                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6 2A9 9 0 113 12a9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-400 uppercase tracking-wider">Peminjaman</span>
            </div>
            <div class="flex items-end justify-between">
                <div>
                    <h3 class="text-4xl font-bold text-gray-800">{{ number_format($bookingsCount) }}</h3>
                    <p class="text-sm text-blue-600 mt-1 flex items-center font-medium">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Transaksi
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-xl font-bold text-gray-800">Peminjaman Terbaru</h3>
            <a href="{{ route('admin.bookings.index') }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm flex items-center">
                Lihat Semua
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-gray-500 uppercase text-xs tracking-wider">
                        <th class="px-8 py-4 font-semibold">Anggota</th>
                        <th class="px-8 py-4 font-semibold">Buku Yang Dipinjam</th>
                        <th class="px-8 py-4 font-semibold">Status</th>
                        <th class="px-8 py-4 font-semibold">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($latestBookings as $booking)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-8 py-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold mr-4">
                                        {{ strtoupper(substr($booking->user->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $booking->user->name }}</p>
                                        <p class="text-xs text-gray-500">ID: {{ str_pad($booking->user->id, 4, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-4">
                                <p class="text-gray-900 font-medium">{{ Str::limit($booking->book->title, 40) }}</p>
                                <p class="text-sm text-gray-500">{{ $booking->book->author ?? '-' }}</p>
                            </td>
                            <td class="px-8 py-4">
                                @if($booking->returned_at)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                        Dikembalikan
                                    </span>
                                @elseif($booking->created_at->addDays(14)->isPast())
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                        Terlambat
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                        Dipinjam
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-4 text-gray-600">
                                {{ $booking->created_at->locale('id')->isoFormat('D MMM YYYY') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-10 text-center text-gray-500">
                                Belum ada data peminjaman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            }).replace('.', ':').replace('.', ':');
            const timeElement = document.getElementById('current-time');
            if (timeElement) {
                timeElement.textContent = timeString + " WIB";
            }
        }
        updateTime();
        setInterval(updateTime, 1000);
    </script>
@endsection
