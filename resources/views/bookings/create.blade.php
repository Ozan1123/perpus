@extends('layouts.app')

@section('content')
    <div class="bg-blue-600 rounded-2xl p-8 mb-8 shadow-lg relative overflow-hidden text-white">
        <h2 class="text-3xl font-bold mb-2 flex items-center">
            <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                </path>
            </svg>
            Tambah Peminjaman Baru
        </h2>
        <p class="text-blue-100 text-lg">Buat data peminjaman buku untuk user secara manual</p>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-8 max-w-2xl mx-auto">
        <form action="{{ route('admin.bookings.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Select User -->
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih User (Peminjam)</label>
                <div class="relative">
                    <select name="user_id" id="user_id" required
                        class="block w-full pl-3 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg bg-gray-50">
                        <option value="" disabled selected>-- Pilih User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>
                @error('user_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Select Book -->
            <div>
                <label for="book_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Buku</label>
                <div class="relative">
                    <select name="book_id" id="book_id" required
                        class="block w-full pl-3 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg bg-gray-50">
                        <option value="" disabled selected>-- Pilih Buku --</option>
                        @foreach($books as $book)
                            <option value="{{ $book->id }}">
                                {{ $book->title }} (Stok: {{ $book->stock }}) - {{ $book->author }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('book_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.bookings.index') }}"
                    class="bg-white py-2 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    Simpan Peminjaman
                </button>
            </div>
        </form>
    </div>
@endsection