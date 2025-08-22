@extends('layouts.app')

@section('content')
    <!-- Section ungu + cards putih -->
    <div class="bg-purple-600 rounded-xl p-6">
        <div class="flex justify-between items-center mb-6 text-white">
            <h2 class="text-xl font-semibold">Welcome, {{ Auth::user()->name ?? 'Guest' }}</h2>
            <span class="text-sm">{{ \Carbon\Carbon::now()->format('l, d M Y') }}</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="text-gray-600 text-sm">Total Books</h3>
                <p class="text-2xl font-bold text-purple-700">{{ \App\Models\Book::count() }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="text-gray-600 text-sm">Total Users</h3>
                <p class="text-2xl font-bold text-purple-700">{{ \App\Models\User::count() }}</p>
            </div>
            <div class="bg-white rounded-lg shadow p-4">
                <h3 class="text-gray-600 text-sm">Last Login</h3>
                <p class="text-gray-700">{{ Auth::user()->last_login ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
@endsection
