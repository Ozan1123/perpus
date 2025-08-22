<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Web PKL</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

@if(session('success'))
  <div class="bg-green-500 text-white p-3 rounded mb-4">
    {{ session('success') }}
  </div>
@endif


<body class="h-screen w-screen relative flex flex-col justify-between">

  <!-- Background dengan overlay -->
  <div class="absolute inset-0 bg-black/50 z-0"></div>
  <div class="absolute inset-0 bg-cover bg-center z-[-1]"
       style="background-image: url('{{ asset('images/wallpaperbetter.jpg') }}');">
  </div>

  <!-- Navbar -->
  <header class="flex justify-between items-center p-6 text-white relative z-10">
    <div class="text-2xl font-bold">Beta Dummy</div>
    {{-- <a href="/" class="hover:underline">Home</a> --}}
  </header>

  <!-- Content -->
  <main class="flex-grow flex justify-center items-center relative z-10">
    <div class="w-full max-w-md bg-white/10 backdrop-blur-lg p-8 rounded-2xl shadow-2xl text-white">
      <h2 class="text-3xl font-bold text-center mb-6">Login</h2>

      {{-- ALERT ERROR --}}
      @if ($errors->any())
        <div class="bg-red-500/80 text-white px-4 py-2 rounded mb-4">
          {{ $errors->first() }}
        </div>
      @endif

      {{-- FORM LOGIN --}}
      <form action="{{ url('/login') }}" method="POST" class="space-y-4">
        @csrf   {{-- Wajib biar ga 419 --}}
        <div>
          <label class="block mb-1">Email</label>
          <input type="email" name="email"
                 class="w-full px-4 py-2 rounded-lg bg-white/20 text-white placeholder-gray-200 outline-none focus:ring-2 focus:ring-indigo-400"
                 placeholder="you@example.com" required>
        </div>
        <div>
          <label class="block mb-1">Password</label>
          <input type="password" name="password"
                 class="w-full px-4 py-2 rounded-lg bg-white/20 text-white placeholder-gray-200 outline-none focus:ring-2 focus:ring-indigo-400"
                 placeholder="••••••" required>
        </div>

        <div class="flex justify-between text-sm">
          <a href="#" class="hover:underline">Forgot Password?</a>
        </div>

        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 py-2 rounded-lg font-semibold transition">
          Sign in
        </button>
      </form>

      <div class="mt-6 text-center text-sm">
        <p class="text-gray-200 mb-2">Or continue with</p>
        <div class="flex justify-center space-x-3">
          <a href="#" class="bg-white/20 px-4 py-2 rounded-lg hover:bg-white/30">Google</a>
          <a href="#" class="bg-white/20 px-4 py-2 rounded-lg hover:bg-white/30">Facebook</a>
          <a href="#" class="bg-white/20 px-4 py-2 rounded-lg hover:bg-white/30">GitHub</a>
        </div>
      </div>

      <p class="mt-6 text-center text-sm text-gray-200">
        Don’t have an account? <a href="/register" class="text-white font-bold hover:underline">Sign up</a>
      </p>
    </div>
  </main>

  <!-- Footer -->
  <footer class="text-center text-white py-4 text-sm relative z-10">
    © 2025 Web PKL. By Ozan, All rights reserved.
  </footer>
</body>
</html>
