<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memuat - ANSHOPP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeInScale {
            0% { opacity: 0; transform: scale(0.8); }
            100% { opacity: 1; transform: scale(1); }
        }
        .animate-splash {
            animation: fadeInScale 1s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-pink-500 via-rose-500 to-pink-600 font-sans text-white min-h-screen flex flex-col items-center justify-center p-4">

    <div class="text-center space-y-6 animate-splash">
        <!-- Logo Animasi Memantul -->
        <div class="w-20 h-20 bg-white text-pink-600 rounded-3xl flex items-center justify-center mx-auto text-4xl font-black shadow-2xl animate-bounce">
            A
        </div>
        
        <div class="space-y-2">
            <h1 class="text-3xl font-black tracking-wider">ANSHOPP</h1>
            <p class="text-xs text-pink-100 font-medium tracking-wide">Halo, <span class="font-bold underline">{{ $username }}</span> ✨</p>
        </div>

        <!-- Loading Bar -->
        <div class="w-48 h-1.5 bg-white/20 rounded-full mx-auto overflow-hidden">
            <div class="h-full bg-white rounded-full animate-pulse w-full"></div>
        </div>

        <p class="text-[11px] text-pink-200 animate-pulse">Menyiapkan katalog kosmetik terbaik untukmu...</p>
    </div>

    <!-- Script Otomatis Masuk ke Katalog Setelah 2.5 Detik -->
    <script>
        setTimeout(function() {
            window.location.href = "/kosmetik";
        }, 2500);
    </script>

</body>
</html>