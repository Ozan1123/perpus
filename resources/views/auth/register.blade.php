<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Perpustakaan</title>
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

  <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl border border-gray-100 my-8">
    <div class="text-center mb-8">
      <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 mb-4">
        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
        </svg>
      </div>
      <h2 class="text-2xl font-bold text-gray-800">Pendaftaran Anggota</h2>
      <p class="text-gray-500 mt-2">Daftar sekarang untuk meminjam buku</p>
    </div>

    @if ($errors->any())
      <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
        <ul class="list-disc pl-5 space-y-1">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ url('/register') }}" method="POST" class="space-y-4">
      @csrf
      <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">Nama Lengkap</label>
        <input type="text" name="name" value="{{ old('name') }}"
          class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all"
          placeholder="Nama Lengkap Anda" required>
      </div>
      <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" value="{{ old('email') }}"
          class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all"
          placeholder="nama@email.com" required>
      </div>
      <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password"
          class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all"
          placeholder="••••••••" required>
      </div>
      <div>
        <label class="block mb-2 text-sm font-medium text-gray-700">Konfirmasi Password</label>
        <input type="password" name="password_confirmation"
          class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all"
          placeholder="••••••••" required>
      </div>

      <button type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition-colors shadow-lg shadow-blue-200 mt-6">
        Daftar Sekarang
      </button>
    </form>

    <p class="mt-8 text-center text-sm text-gray-500">
      Sudah punya akun? <a href="/login" class="text-blue-600 font-bold hover:underline">Masuk disini</a>
    </p>
  </div>

  <footer class="mb-8 text-center text-gray-400 text-sm">
    &copy; {{ date('Y') }} Perpustakaan Digital.
  </footer>
</body>

</html>