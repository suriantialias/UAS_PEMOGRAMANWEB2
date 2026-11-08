<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Owner - ANSHOPP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 font-sans text-gray-700 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-xl max-w-sm w-full space-y-6">
        <div class="text-center space-y-1">
            <div class="w-12 h-12 bg-pink-100 text-pink-600 rounded-full flex items-center justify-center mx-auto text-xl font-bold">
                🔒
            </div>
            <h1 class="text-xl font-black text-gray-800">Owner Portal</h1>
            <p class="text-xs text-gray-400">Masukkan password rahasia untuk mengakses panel toko.</p>
        </div>

        @if(session('error'))
            <div class="bg-red-50 text-red-600 p-3 rounded-lg text-xs font-semibold text-center">
                {{ session('error') }}
            </div>
        @endif

        <form action="/kosmetik/owner/login" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block font-medium text-gray-600 text-xs mb-1">Password Owner</label>
                <input type="password" name="password" required placeholder="••••••••" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-xs focus:outline-pink-500">
            </div>

            <button type="submit" class="w-full bg-pink-600 text-white py-2.5 rounded-lg font-bold text-xs hover:bg-pink-700 transition shadow-sm">
                Masuk Dashboard 🚀
            </button>
        </form>

        <div class="text-center pt-2">
            <a href="/kosmetik" class="text-xs text-gray-400 hover:text-pink-600 transition">
                &larr; Kembali ke Toko (Customer)
            </a>
        </div>
    </div>

</body>
</html>