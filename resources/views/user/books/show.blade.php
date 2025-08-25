@extends('layouts.app')

@section('content')
    <div class="bg-purple-600 rounded-xl p-6">
        <div class="flex justify-between items-center mb-6 text-white">
            <h2 class="text-xl font-semibold">📖 Book Detail</h2>
        </div>

        <!-- Card putih -->
        <div class="bg-white rounded-lg shadow p-6 flex flex-col md:flex-row">
            <!-- Cover -->
            <div class="flex-shrink-0 mb-4 md:mb-0 md:mr-6 text-center">
                @if($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}"
                         alt="Cover"
                         class="w-40 h-56 object-cover mx-auto rounded-lg shadow">
                @else
                    <div class="w-40 h-56 flex items-center justify-center bg-gray-200 text-gray-500 rounded-lg">
                        No cover
                    </div>
                @endif
            </div>

            <!-- Info -->
            <div class="flex-1">
                <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $book->title }}</h3>
                <p class="text-gray-600 mb-4">by <span class="font-medium">{{ $book->author }}</span></p>

                {{-- Tombol Booking --}}
                <form action="{{ route('user.books.book', $book->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
                        📚 Book Now
                    </button>
                </form>

                {{-- Tombol Back --}}
                <div class="mt-4">
                    <a href="{{ route('user.books.index') }}"
                       class="text-sm text-gray-600 hover:underline">
                        ← Back to Books List
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
