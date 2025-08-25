@extends('layouts.app')

@section('content')
    <!-- Welcome Header dengan warna ungu -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-500 rounded-2xl p-8 mb-8 shadow-lg relative overflow-hidden">
        <!-- Ornamen -->
        <div class="absolute top-0 right-0 w-28 h-28 bg-white bg-opacity-10 rounded-full transform translate-x-12 -translate-y-12"></div>
        <div class="absolute bottom-0 left-0 w-20 h-20 bg-white bg-opacity-5 rounded-full transform -translate-x-8 translate-y-8"></div>

        <div class="relative z-10">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center text-white">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold mb-2">Halo, {{ Auth::user()->name ?? 'Guest' }}</h2>
                    <p class="text-purple-100 text-lg">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
                </div>
                <div class="mt-4 md:mt-0 flex items-center text-purple-100">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                    </svg>
                    <span id="current-time" class="font-medium"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Books -->
        <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-1 overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-sm font-semibold text-gray-500 uppercase">Total Buku</p>
                    <div class="bg-purple-500 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13M7.5 5C6 5 4.5 5.477 3 6.253v13C4.5 18.477 6 18 7.5 18S10.5 18.477 12 19.253m0-13C13.5 5.477 15 5 16.5 5c1.5 0 3 .477 4.5 1.253v13C19.5 18.477 18 18 16.5 18S13.5 18.477 12 19.253"/>
                        </svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-purple-700">{{ \App\Models\Book::count() }}</p>
            </div>
            <div class="h-1 bg-gradient-to-r from-purple-500 to-purple-600"></div>
        </div>

        <!-- Total Peminjaman User -->
        <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-1 overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-sm font-semibold text-gray-500 uppercase">Peminjaman Saya</p>
                    <div class="bg-pink-500 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4v12l-4-2-4 2V4z" />
                        </svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-pink-600">
                    {{ Auth::user()->bookings()->count() }}
                </p>
            </div>
            <div class="h-1 bg-gradient-to-r from-pink-500 to-pink-600"></div>
        </div>

        <!-- Last Login -->
        <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-1 overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-sm font-semibold text-gray-500 uppercase">Login Terakhir</p>
                    <div class="bg-indigo-500 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6 2A9 9 0 113 12a9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-base font-medium text-gray-700">
                    {{ Auth::user()->last_login ? \Carbon\Carbon::parse(Auth::user()->last_login)->locale('id')->isoFormat('D MMM YYYY, HH:mm') : 'N/A' }}
                </p>
            </div>
            <div class="h-1 bg-gradient-to-r from-indigo-500 to-indigo-600"></div>
        </div>
    </div>

    <!-- Tambahan: daftar peminjaman user -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Peminjaman Terbaru Saya</h3>
        </div>
        @if(Auth::user()->bookings()->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Buku</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach(Auth::user()->bookings()->latest()->take(5)->get() as $booking)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $booking->book->title }}</td>
                                <td class="px-6 py-4 text-sm">
                                    @if($booking->returned_at)
                                        <span class="text-green-600 font-medium">Dikembalikan</span>
                                    @else
                                        <span class="text-yellow-600 font-medium">Dipinjam</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $booking->created_at->locale('id')->isoFormat('D MMM YYYY') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-10 text-gray-500">
                Belum ada peminjaman.
            </div>
        @endif
    </div>

    <script>
        function updateTime() {
            const now = new Date();
            document.getElementById('current-time').textContent = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
        }
        updateTime();
        setInterval(updateTime, 1000);
    </script>
@endsection
