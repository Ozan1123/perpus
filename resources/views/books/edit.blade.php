@extends('layouts.app')

@section('content')
<div class="p-6">
    {{-- Header --}}
    <div class="bg-purple-600 text-white rounded-t-xl px-6 py-3 flex items-center">
        <i class="fas fa-edit mr-2"></i>
        <h2 class="text-xl font-semibold">Edit Book</h2>
    </div>

    {{-- Body --}}
    <div class="bg-white shadow-md rounded-b-xl p-6">
        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="mb-4">
                <label class="block font-semibold mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title', $book->title) }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Author --}}
            <div class="mb-4">
                <label class="block font-semibold mb-1">Author</label>
                <input type="text" name="author" value="{{ old('author', $book->author) }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500">
                @error('author')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Cover --}}
            <div class="mb-4">
                <label class="block font-semibold mb-1">Cover</label>
                <input type="file" name="cover"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-50 focus:ring-2 focus:ring-purple-500">
                @error('cover')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                {{-- Preview cover lama --}}
                @if($book->cover)
                    <div class="mt-3">
                        <p class="text-gray-600 text-sm mb-1">Current Cover:</p>
                        <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover" class="w-32 h-40 object-cover rounded shadow">
                    </div>
                @endif
            </div>

            {{-- Buttons --}}
            <div class="flex gap-3">
                <button type="submit"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-lg shadow">
                    Update
                </button>
                <a href="{{ route('books.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-5 py-2 rounded-lg shadow">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
