<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Anshopp Kosmetik</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-pink-50 via-white to-pink-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-md p-8 rounded-3xl shadow-xl border border-pink-100">
        <!-- Header / Judul -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-pink-600 tracking-wide">Anshopp Kosmetik</h1>
            <p class="text-gray-500 text-sm mt-1">Silakan masuk untuk melanjutkan belanja</p>
        </div>

        <!-- Form Login Customer -->
        <form action="{{ route('kosmetik.processLogin') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Nama Customer</label>
                <input type="text" name="name" placeholder="Masukkan nama Anda..." required 
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-pink-400 text-sm">
            </div>
            <button type="submit" 
                class="w-full bg-pink-600 hover:bg-pink-700 text-white font-bold py-3 rounded-xl transition duration-200 shadow-md shadow-pink-200 text-sm">
                Masuk sebagai Customer
            </button>
        </form>

        <!-- Divider / Garis Pembatas -->
        <div class="flex items-center my-6">
            <div class="flex-grow border-t border-gray-200"></div>
            <span class="px-3 text-gray-400 text-xs font-medium uppercase tracking-wider">Atau</span>
            <div class="flex-grow border-t border-gray-200"></div>
        </div>

        <!-- Tombol Akses Owner / Admin (Dibuat Lebih Kecil & Minimalis) -->
        <div class="text-center">
            <a href="{{ route('kosmetik.owner.login') }}" 
               class="inline-block text-gray-500 hover:text-gray-800 text-xs font-semibold py-2 px-4 rounded-lg hover:bg-gray-100 transition duration-200">
                🔐 Masuk sebagai Owner / Admin
            </a>
        </div>
    </div>

</body>
</html>