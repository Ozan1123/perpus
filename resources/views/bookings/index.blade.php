@extends('layouts.app')

@section('content')
    <div class="bg-purple-600 rounded-xl p-6">
        <div class="flex justify-between items-center mb-6 text-white">
            <h2 class="text-xl font-semibold">📖 Bookings List</h2>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border text-left">Book Title</th>
                        <th class="px-4 py-2 border text-left">User</th>
                        <th class="px-4 py-2 border text-left">Booked At</th>
                        <th class="px-4 py-2 border text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $booking->book->title }}</td>
                            <td class="px-4 py-2 border">{{ $booking->user_name }}</td>
                            <td class="px-4 py-2 border">{{ $booking->booked_at }}</td>
                            <td class="px-4 py-2 border text-center">
                                <form action="{{ route('bookings.destroy', $booking) }}" method="POST"
                                      onsubmit="return confirm('Cancel this booking?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                        Cancel
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-3 text-center text-gray-500">
                                No bookings found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
