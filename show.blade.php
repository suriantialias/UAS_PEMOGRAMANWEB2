<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product['name'] }} - ANSHOPP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-700">

    <!-- Header Sederhana & Rapi -->
    <header class="bg-white border-b border-gray-200 py-4 px-6 text-center">
        <h1 class="text-2xl font-black text-pink-600 tracking-wide">ANSHOPP</h1>
        <div class="flex justify-center gap-6 mt-2 text-xs font-medium">
            <a href="/kosmetik" class="text-pink-600 font-bold border-b-2 border-pink-600 pb-0.5">Katalog Produk</a>
            <a href="/kosmetik/cart" class="text-gray-500 hover:text-pink-600 transition">Keranjang</a>
            <a href="/kosmetik/contact" class="text-gray-500 hover:text-pink-600 transition">Kontak</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-3xl mx-auto px-4 py-8">
        <div class="mb-4">
            <a href="/kosmetik" class="text-xs text-pink-600 hover:underline font-medium">&larr; Kembali ke Katalog</a>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
            <!-- Gambar Produk -->
            <div class="w-full h-64 md:h-full bg-pink-50 rounded-lg overflow-hidden border border-pink-100 flex items-center justify-center">
                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover">
            </div>

            <!-- Info Produk -->
            <div class="flex flex-col justify-between space-y-4">
                <div>
                    <span class="text-[10px] font-bold px-2.5 py-1 bg-pink-100 text-pink-600 rounded-full">
                        {{ $product['category'] }}
                    </span>
                    <h2 class="text-xl font-bold text-gray-800 mt-2">{{ $product['name'] }}</h2>
                    <p class="text-pink-600 font-black text-lg mt-1">Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
                    
                    <div class="mt-4 border-t pt-4">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Deskripsi Produk</h3>
                        <p class="text-xs text-gray-600 leading-relaxed">{{ $product['description'] }}</p>
                    </div>
                </div>

                <!-- Form Tambah ke Keranjang dengan Qty -->
                <div class="pt-4 border-t space-y-3">
                    <form action="/kosmetik/add-to-cart/{{ $product['id'] }}" method="GET" class="flex items-center gap-3">
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-500 mb-1">Jumlah</label>
                            <input type="number" name="qty" min="1" value="1" class="w-20 border border-gray-200 rounded-lg px-3 py-2 text-center text-xs font-bold focus:outline-pink-500">
                        </div>
                        <div class="flex-1 pt-5">
                            <button type="submit" class="w-full bg-pink-600 text-white py-2 rounded-lg font-medium text-xs hover:bg-pink-700 transition shadow-sm">
                                + Masukkan Keranjang 🛒
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
