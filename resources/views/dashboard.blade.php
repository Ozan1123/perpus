@extends('layouts.app')

@section('content')
    <!-- Header -->
    <div class="bg-purple-600 rounded-xl p-6 mb-6">
        <div class="flex justify-between items-center text-white">
            <h2 class="text-xl font-semibold">Welcome, {{ Auth::user()->name ?? 'Guest' }}</h2>
            <span class="text-sm">{{ \Carbon\Carbon::now()->format('l, d M Y') }}</span>
        </div>
    </div>

    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="text-gray-600 text-sm">Total Books</h3>
            <p class="text-2xl font-bold text-purple-700">{{ $booksCount }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="text-gray-600 text-sm">Total Users</h3>
            <p class="text-2xl font-bold text-purple-700">{{ $usersCount }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="text-gray-600 text-sm">Total Bookings</h3>
            <p class="text-2xl font-bold text-purple-700">{{ $bookingsCount }}</p>
        </div>
    </div>

    <!-- Latest Bookings -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4 text-gray-700">Latest Bookings</h3>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2 border-b">User</th>
                    <th class="px-4 py-2 border-b">Book</th>
                    <th class="px-4 py-2 border-b">Status</th>
                    <th class="px-4 py-2 border-b">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($latestBookings as $booking)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $booking->user->name }}</td>
                        <td class="px-4 py-2 border-b">{{ $booking->book->title }}</td>
                        <td class="px-4 py-2 border-b">
                            @if($booking->returned_at)
                                <span class="text-green-600 font-semibold">Returned</span>
                            @else
                                <span class="text-yellow-600 font-semibold">Borrowed</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border-b">{{ $booking->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-3 text-gray-500">No recent bookings.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
