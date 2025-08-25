<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'MyApp') }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex min-h-screen">

    <!-- Sidebar (abu-abu) -->
    <aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
        <h2 class="text-xl font-bold mb-6">📚 Perpustakaan</h2>
        @php
            $user = auth()->user();
            $isAdmin = $user && (
                ($user->role ?? null) === 'admin' ||
                (isset($user->is_admin) && (int)$user->is_admin === 1)
            );
        @endphp
        <nav class="space-y-2">
            <a href="{{ $isAdmin ? route('admin.dashboard') : route('user.dashboard') }}"
               class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->routeIs($isAdmin ? 'admin.dashboard' : 'user.dashboard') ? 'bg-gray-700' : '' }}">
                Dashboard
            </a>

            @if($isAdmin)
                <a href="{{ route('admin.books.index') }}"
                   class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('admin/books*') ? 'bg-gray-700' : '' }}">
                    Books
                </a>
            @else
                <a href="{{ route('user.books.index') }}"
                   class="block px-3 py-2 rounded hover:bg-gray-700 {{ request()->is('user/books*') ? 'bg-gray-700' : '' }}">
                    Books
                </a>
            @endif
        </nav>

        <form action="{{ route('logout') }}" method="POST" class="mt-6">
            @csrf
            <button type="submit"
                    class="w-full text-left px-3 py-2 rounded bg-red-500 text-white hover:bg-red-600">
                Logout
            </button>
        </form>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Topbar -->
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <h1 class="text-lg font-semibold">
                {{ $isAdmin ? 'Admin Dashboard' : 'User Dashboard' }}
            </h1>
            <span class="text-gray-600">Hi, {{ auth()->user()->name ?? 'Guest' }}</span>
        </header>

        <!-- Page Content -->
        <main class="p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>
x