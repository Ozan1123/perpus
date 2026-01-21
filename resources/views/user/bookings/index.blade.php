@extends('layouts.app')

@section('content')
    <div class="bg-blue-600 rounded-2xl p-8 mb-8 shadow-lg relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-white bg-opacity-10 rounded-full transform translate-x-16 -translate-y-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white bg-opacity-5 rounded-full transform -translate-x-12 translate-y-12"></div>

        <div class="relative z-10 flex justify-between items-center text-white">
            <div>
                <h2 class="text-3xl font-bold mb-2 flex items-center">
                    <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Peminjaman Saya
                </h2>
                <p class="text-blue-100 text-lg">Kelola buku yang sedang Anda pinjam</p>
            </div>

            <a href="{{ route('user.books.index') }}" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg backdrop-blur-sm transition flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Pinjam Buku Baru
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 m-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 p-4 m-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Timeline / Batas Waktu</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-blue-50/50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-16 w-12 bg-gray-200 rounded overflow-hidden shadow-sm">
                                        @if($booking->book->cover)
                                            <img class="h-16 w-12 object-cover" src="{{ asset('storage/' . $booking->book->cover) }}" alt="{{ $booking->book->title }}">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center text-gray-400">
                                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-gray-900">{{ $booking->book->title }}</div>
                                        <div class="text-sm text-gray-500">{{ $booking->book->author }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 font-medium">
                                    {{ $booking->booked_at ? $booking->booked_at->format('d M Y') : '-' }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $booking->booked_at ? $booking->booked_at->format('H:i') : '' }} WIB
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($booking->returned_at)
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Sudah Dikembalikan
                                    </span>
                                    <div class="text-xs text-gray-500 mt-1">
                                        {{ $booking->returned_at->format('d M Y') }}
                                    </div>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Sedang Dipinjam
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if(!$booking->returned_at)
                                    @php
                                        $dueDate = $booking->booked_at->copy()->addDays(7);
                                        $daysLeft = now()->diffInDays($dueDate, false);
                                    @endphp
                                    <div class="flex flex-col">
                                        <span class="text-sm font-medium text-gray-900">
                                            Batas: {{ $dueDate->format('d M Y') }}
                                        </span>
                                        @if($daysLeft < 0)
                                            <span class="text-xs text-red-600 font-bold mt-1">Terlambat {{ abs(intval($daysLeft)) }} hari</span>
                                        @elseif($daysLeft == 0)
                                            <span class="text-xs text-orange-600 font-bold mt-1">Hari terakhir!</span>
                                        @else
                                            <span class="text-xs text-green-600 mt-1">Sisa {{ intval($daysLeft) }} hari</span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                    <p class="text-gray-500 text-lg mb-2">Belum ada peminjaman</p>
                                    <p class="text-gray-400 text-sm mb-6">Anda belum meminjam buku apapun saat ini.</p>
                                    <a href="{{ route('user.books.index') }}" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition shadow-sm">
                                        Mulai Meminjam
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
