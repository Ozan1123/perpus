<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Web PKL</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen w-screen relative flex flex-col justify-between">

  <!-- Background dengan overlay -->
  <div class="absolute inset-0 bg-black/50 z-0"></div>
  <div class="absolute inset-0 bg-cover bg-center z-[-1]"
       style="background-image: url('{{ asset('images/wallpaperbetter.jpg') }}');">
  </div>

  <!-- Navbar -->
  <header class="flex justify-between items-center p-6 text-white relative z-10">
    <div class="text-2xl font-bold">Beta Dummy</div>
  </header>

  <!-- Content -->
  <main class="flex-grow flex justify-center items-center relative z-10">
    <div class="w-full max-w-md bg-white/10 backdrop-blur-lg p-8 rounded-2xl shadow-2xl text-white">
      <h2 class="text-3xl font-bold text-center mb-6">Register</h2>

      <form action="{{ url('/register') }}" method="POST" class="space-y-4">
        @csrf
        <div>
          <label class="block mb-1">Name</label>
          <input type="text" name="name"
                 class="w-full px-4 py-2 rounded-lg bg-white/20 text-white placeholder-gray-200 outline-none focus:ring-2 focus:ring-indigo-400"
                 placeholder="Your Name" required>
        </div>
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

        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 py-2 rounded-lg font-semibold transition">
          Sign up
        </button>
      </form>

      <p class="mt-6 text-center text-sm text-gray-200">
        Already have an account? <a href="/login" class="text-white font-bold hover:underline">Sign in</a>
      </p>
    </div>
  </main>

  <!-- Footer -->
  <footer class="text-center text-white py-4 text-sm relative z-10">
    © 2025 Web PKL. By Ozan, All rights reserved.
  </footer>
</body>
</html>
