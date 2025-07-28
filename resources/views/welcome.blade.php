<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Frequenz Media</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-cover bg-center bg-no-repeat min-h-screen flex items-center justify-center text-white"
      style="background-image: url('{{ asset('images/background.jpg') }}');">

    <div class="text-center px-4">
        <!-- Logo -->
        <div class="flex justify-center mb-5">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-40 h-40">
        </div>

        <!-- Judul -->
        <h1 class="text-4xl font-extrabold text-blue-400 mb-3">Frequenz Media</h1>
        <p class="text-gray-300 text-lg mb-8 max-w-xl mx-auto">
            Aplikasi pengelolaan Studio Frequenz Media
        </p>

        <!-- Tombol -->
        <div class="flex justify-center gap-4">
            <a href="{{ route('login') }}"
               class="px-6 py-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-full font-semibold transition">
                LOGIN
            </a>
            <a href="{{ route('register') }}"
               class="px-6 py-2 border border-blue-400 hover:bg-blue-600 hover:text-white text-blue-300 rounded-full font-semibold transition">
                REGISTER
            </a>
        </div>
    </div>

</body>
</html>
