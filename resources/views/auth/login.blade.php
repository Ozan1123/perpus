<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Perpustakaan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>

<body class="bg-gray-50 h-screen w-screen flex flex-col justify-center items-center">

  <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
    <div class="text-center mb-8">
      <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 mb-4">
        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
          </path>
        </svg>
      </div>
      <h2 class="text-2xl font-bold text-gray-800">Selamat Datang</h2>
      <p class="text-gray-500 mt-2">Silahkan login untuk mengakses perpustakaan</p>
    </div>

    @if (session('success'))
      <div class="mb-6 flex items-center p-4 text-green-800 rounded-lg bg-green-50 border border-green-200" role="alert">
        <svg class="flex-shrink-0 w-5 h-5 text-green-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
          viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span class="text-sm font-medium">{{ session('success') }}</span>
      </div>
    @endif

    @if ($errors->any())
      <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
        {{ $errors->first() }}
      </div>
    @endif

    <form action="{{ url('/login') }}" method="POST" class="space-y-5">
      @csrf
      <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email"
          class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all"
          placeholder="nama@email.com" required>
      </div>
      <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password"
          class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all"
          placeholder="••••••••" required>
      </div>

      <div class="flex justify-between items-center text-sm">
        <label class="flex items-center text-gray-500">
          <input type="checkbox" class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500"> Ingat saya
        </label>
        <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Lupa Password?</a>
      </div>

      <button type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition-colors shadow-lg shadow-blue-200">
        Masuk
      </button>
    </form>

    <p class="mt-8 text-center text-sm text-gray-500">
      Belum punya akun? <a href="/register" class="text-blue-600 font-bold hover:underline">Daftar sekarang</a>
    </p>
  </div>

  <footer class="mt-8 text-center text-gray-400 text-sm">
    &copy; {{ date('Y') }} Perpustakaan Digital.
  </footer>
</body>

</html>