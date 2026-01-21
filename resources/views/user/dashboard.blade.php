@extends('layouts.app')

@section('content')
    <!-- Welcome Header -->
    <div class="bg-blue-600 rounded-2xl p-8 mb-8 shadow-lg text-white relative overflow-hidden">
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center">
            <div>
                <h2 class="text-3xl font-bold mb-2">Halo, {{ Auth::user()->name ?? 'Anggota' }}</h2>
                <p class="text-blue-100 text-lg">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
            </div>
            <div class="mt-4 md:mt-0 bg-blue-700 bg-opacity-50 px-6 py-3 rounded-xl backdrop-blur-sm border border-blue-500">
                <span id="current-time" class="text-2xl font-mono font-bold tracking-wider"></span>
            </div>
        </div>
        <!-- Subtle pattern -->
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-48 h-48 bg-white opacity-10 rounded-full blur-2xl"></div>
        <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-32 h-32 bg-green-400 opacity-20 rounded-full blur-2xl"></div>
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
                    <h3 class="text-4xl font-bold text-gray-800">{{ \App\Models\Book::count() }}</h3>
                    <p class="text-sm text-gray-500 mt-1">Koleksi buku tersedia</p>
                </div>
            </div>
        </div>

        <!-- My Bookings -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-orange-50 p-3 rounded-xl group-hover:bg-orange-100 transition-colors">
                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6 2A9 9 0 113 12a9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-400 uppercase tracking-wider">Peminjaman Saya</span>
            </div>
            <div class="flex items-end justify-between">
                <div>
                    <h3 class="text-4xl font-bold text-gray-800">{{ Auth::user()->bookings()->count() }}</h3>
                    <p class="text-sm text-gray-500 mt-1">Total riwayat peminjaman</p>
                </div>
            </div>
        </div>

        <!-- Last Login -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-green-50 p-3 rounded-xl group-hover:bg-green-100 transition-colors">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <span class="text-sm font-medium text-gray-400 uppercase tracking-wider">Login Terakhir</span>
            </div>
            <div class="flex items-end justify-between">
                <div>
                    <p class="text-lg font-bold text-gray-800">
                        {{ Auth::user()->last_login ? \Carbon\Carbon::parse(Auth::user()->last_login)->locale('id')->isoFormat('D MMM, HH:mm') : 'Baru saja' }}
                    </p>
                    <p class="text-sm text-gray-500 mt-1">Akses terakhir ke sistem</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-xl font-bold text-gray-800">Peminjaman Terbaru Saya</h3>
            <a href="{{ route('user.bookings.index') }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm flex items-center">
                Lihat Riwayat
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-gray-500 uppercase text-xs tracking-wider">
                        <th class="px-8 py-4 font-semibold">Buku Yang Dipinjam</th>
                        <th class="px-8 py-4 font-semibold">Status</th>
                        <th class="px-8 py-4 font-semibold">Tanggal Peminjaman</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse(Auth::user()->bookings()->latest()->take(5)->get() as $booking)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-8 py-4">
                                <p class="text-gray-900 font-medium">{{ $booking->book->title }}</p>
                                <p class="text-sm text-gray-500">{{ $booking->book->author ?? '-' }}</p>
                            </td>
                            <td class="px-8 py-4">
                                @if($booking->returned_at)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                        Dikembalikan
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
                            <td colspan="3" class="px-8 py-10 text-center text-gray-500">
                                Belum ada riwayat peminjaman.
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
