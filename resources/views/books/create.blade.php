@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="bg-purple-600 text-white rounded-t-xl px-6 py-3 flex items-center">
        <i class="fas fa-plus mr-2"></i>
        <h2 class="text-xl font-semibold">Add Book</h2>
    </div>

    <div class="bg-white shadow-md rounded-b-xl p-6">
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Title --}}
            <div class="mb-4">
                <label class="block font-semibold mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title') }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-purple-500">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Author --}}
            <div class="mb-4">
                <label class="block font-semibold mb-1">Author</label>
                <input type="text" name="author" value="{{ old('author') }}"
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
            </div>

            {{-- Buttons --}}
            <div class="flex gap-3">
                <button type="submit"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-lg shadow">
                    Save
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
