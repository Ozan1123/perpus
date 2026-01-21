<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Perpustakaan') }}</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-72 bg-white border-r border-gray-200 min-h-screen flex flex-col shadow-sm">
        <div class="p-6 border-b border-gray-100 mb-4">
            <h2 class="text-2xl font-bold text-blue-600 flex items-center gap-2">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                    </path>
                </svg>
                Perpustakaan
            </h2>
        </div>

        @php
            $user = auth()->user();
            $isAdmin = $user && (
                ($user->role ?? null) === 'admin' ||
                (isset($user->is_admin) && (int) $user->is_admin === 1)
            );
        @endphp

        <nav class="flex-1 px-4 space-y-2">
            <a href="{{ $isAdmin ? route('admin.dashboard') : route('user.dashboard') }}"
                class="flex items-center px-4 py-3 rounded-xl text-lg transition-colors {{ request()->routeIs($isAdmin ? 'admin.dashboard' : 'user.dashboard') ? 'bg-blue-50 text-blue-700 font-semibold shadow-sm ring-1 ring-blue-200' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
                Dashboard
            </a>

            @if($isAdmin)
                <a href="{{ route('admin.books.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-lg transition-colors {{ request()->is('admin/books*') ? 'bg-blue-50 text-blue-700 font-semibold shadow-sm ring-1 ring-blue-200' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                    Kola Buku
                </a>

                <a href="{{ route('admin.bookings.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-lg transition-colors {{ request()->is('admin/bookings*') ? 'bg-blue-50 text-blue-700 font-semibold shadow-sm ring-1 ring-blue-200' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                        </path>
                    </svg>
                    Peminjaman
                </a>
            @else
                <a href="{{ route('user.books.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-lg transition-colors {{ request()->is('user/books*') ? 'bg-blue-50 text-blue-700 font-semibold shadow-sm ring-1 ring-blue-200' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                    Daftar Buku
                </a>

                <a href="{{ route('user.bookings.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-lg transition-colors {{ request()->is('user/bookings*') ? 'bg-blue-50 text-blue-700 font-semibold shadow-sm ring-1 ring-blue-200' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6 2A9 9 0 113 12a9 9 0 0118 0z"></path>
                    </svg>
                    Riwayat
                </a>
            @endif
        </nav>

        <div class="p-4 border-t border-gray-100">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="flex items-center w-full px-4 py-3 text-lg font-medium text-red-600 rounded-xl hover:bg-red-50 transition-colors">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        <!-- Topbar -->
        <header class="bg-white border-b border-gray-200 px-8 py-5 flex justify-between items-center shadow-sm z-10">
            <h1 class="text-2xl font-bold text-gray-800">
                {{ $isAdmin ? 'Dashboard Admin' : 'Dashboard Anggota' }}
            </h1>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-lg font-semibold text-gray-800">{{ auth()->user()->name ?? 'Pengunjung' }}</p>
                    <p class="text-sm text-gray-500">{{ $isAdmin ? 'Administrator' : 'Anggota Perpustakaan' }}</p>
                </div>
                <div
                    class="h-12 w-12 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold text-xl ring-2 ring-orange-200">
                    {{ strtoupper(substr(auth()->user()->name ?? 'G', 0, 1)) }}
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-8 bg-gray-50 scroll-smooth">
            @yield('content')
        </main>
    </div>
</body>

</html>
x