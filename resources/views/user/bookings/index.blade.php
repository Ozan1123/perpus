@extends('layouts.app')

@section('content')
    <div class="bg-gradient-to-r from-blue-600 to-purple-500 rounded-xl p-6">
        <div class="flex justify-between items-center mb-6 text-white">
            <h2 class="text-xl font-semibold">📖 My Bookings</h2>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border text-left">Cover</th>
                        <th class="px-4 py-2 border text-left">Title</th>
                        <th class="px-4 py-2 border text-left">Author</th>
                        <th class="px-4 py-2 border text-left">Booked At</th>
                        <th class="px-4 py-2 border text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border text-center">
                                @if($booking->book->cover)
                                    <img src="{{ asset('storage/' . $booking->book->cover) }}"
                                         alt="Cover" class="w-16 h-20 object-cover mx-auto rounded">
                                @else
                                    <span class="text-gray-400">No cover</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 border">{{ $booking->book->title }}</td>
                            <td class="px-4 py-2 border">{{ $booking->book->author }}</td>
                            <td class="px-4 py-2 border">{{ $booking->booked_at->format('d M Y H:i') }}</td>
                            <td class="px-4 py-2 border text-center">
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-center text-gray-500">
                                No bookings yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
