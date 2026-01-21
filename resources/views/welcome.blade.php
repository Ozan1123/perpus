<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Perpustakaan') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <nav
            class="bg-white/80 backdrop-blur-md border-b border-gray-100 fixed w-full z-50 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center gap-2">
                            <div class="bg-blue-600 p-1.5 rounded-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                            </div>
                            <span class="font-bold text-xl tracking-tight text-gray-900">Perpustakaan</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="font-medium text-gray-600 hover:text-blue-600 transition">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="font-medium text-gray-600 hover:text-blue-600 transition">Masuk</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all hover:shadow-lg">
                                        Daftar
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="flex-grow pt-24 pb-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:grid lg:grid-cols-12 lg:gap-8 items-center">
                    <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                        <h1>
                            <span
                                class="block text-sm font-semibold uppercase tracking-wide text-blue-600 mb-2">Perpustakaan
                                Digital Modern</span>
                            <span class="mt-1 block text-4xl tracking-tight font-extrabold sm:text-5xl xl:text-6xl">
                                <span class="block text-gray-900">Jendela Dunia di</span>
                                <span class="block text-blue-600">Genggaman Anda</span>
                            </span>
                        </h1>
                        <p
                            class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Akses ribuan buku, jurnal, dan referensi berkualitas dari mana saja. Tingkatkan wawasan dan
                            pengetahuan Anda bersama kami.
                        </p>
                        <div class="mt-8 sm:max-w-lg sm:mx-auto sm:text-center lg:text-left lg:mx-0">
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="{{ route('login') }}"
                                    class="flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg shadow-lg hover:shadow-blue-500/30 transition-all">
                                    Mulai Membaca
                                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                                <a href="#features"
                                    class="flex items-center justify-center px-8 py-3 border border-gray-300 text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 md:py-4 md:text-lg shadow-sm transition-all">
                                    Pelajari Lebih Lanjut
                                </a>
                            </div>
                        </div>
                    </div>
                    <div
                        class="mt-12 relative sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 lg:flex lg:items-center">
                        <div class="relative mx-auto w-full rounded-lg shadow-lg lg:max-w-md">
                            <div
                                class="relative block w-full bg-white rounded-lg overflow-hidden focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <div class="bg-blue-50 p-8 rounded-2xl relative overflow-hidden">
                                    <!-- Decorative blobs -->
                                    <div
                                        class="absolute top-0 right-0 w-32 h-32 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob">
                                    </div>
                                    <div
                                        class="absolute bottom-0 left-0 w-32 h-32 bg-green-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000">
                                    </div>
                                    <div
                                        class="absolute -bottom-8 right-20 w-32 h-32 bg-orange-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000">
                                    </div>

                                    <img src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1952&q=80"
                                        alt="Library"
                                        class="relative rounded-xl shadow-2xl transform hover:scale-105 transition duration-500">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div id="features" class="py-16 bg-white mt-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Fitur Unggulan</h2>
                        <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                            Mengapa Memilih Perpustakaan Kami?
                        </p>
                    </div>

                    <div class="mt-10">
                        <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-3">
                            <div
                                class="border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow">
                                <div
                                    class="flex items-center justify-center h-12 w-12 rounded-xl bg-blue-100 text-blue-600 mb-4">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Koleksi Lengkap</h3>
                                <p class="mt-2 text-base text-gray-500">
                                    Menyediakan berbagai genre buku mulai dari fiksi, non-fiksi, hingga jurnal ilmiah.
                                </p>
                            </div>

                            <div
                                class="border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow">
                                <div
                                    class="flex items-center justify-center h-12 w-12 rounded-xl bg-green-100 text-green-600 mb-4">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Akses 24/7</h3>
                                <p class="mt-2 text-base text-gray-500">
                                    Layanan peminjaman dan pengembalian yang fleksibel, dapat diakses kapan saja.
                                </p>
                            </div>

                            <div
                                class="border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow">
                                <div
                                    class="flex items-center justify-center h-12 w-12 rounded-xl bg-orange-100 text-orange-600 mb-4">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Cepat & Mudah</h3>
                                <p class="mt-2 text-base text-gray-500">
                                    Proses peminjaman yang simpel dan cepat tanpa antrian panjang.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-50 border-t border-gray-200">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <p class="text-center text-base text-gray-400">
                    &copy; {{ date('Y') }} Perpustakaan Digital. All rights reserved.
                </p>
            </div>
        </footer>
    </div>

    <style>
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</body>

</html>