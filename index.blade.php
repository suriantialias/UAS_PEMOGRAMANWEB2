<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk - ANSHOPP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-700">

    <!-- Header -->
    <header class="bg-white border-b border-gray-200 py-4 px-6 text-center sticky top-0 z-40 shadow-sm">
        <h1 class="text-2xl font-black text-pink-600 tracking-wide">ANSHOPP</h1>
        <p class="text-[11px] text-gray-400">Halo, <span class="font-bold text-pink-600">{{ session('username') }}</span> ✨</p>
        <div class="flex justify-center gap-6 mt-2 text-xs font-medium">
            <a href="/kosmetik" class="text-pink-600 font-bold border-b-2 border-pink-600 pb-0.5">Katalog Produk</a>
            <a href="/kosmetik/cart" class="text-gray-500 hover:text-pink-600 transition">Keranjang 🛒</a>
            <a href="/kosmetik/contact" class="text-gray-500 hover:text-pink-600 transition">Kontak</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-5xl mx-auto px-4 py-6 space-y-6">
        
        <!-- Search & Filter Bar -->
        <form action="/kosmetik" method="GET" class="bg-white p-4 rounded-xl border border-gray-200 flex flex-col sm:flex-row gap-3 justify-between items-center text-xs shadow-sm">
            <div class="w-full sm:w-80 flex gap-2">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari produk kosmetik / skincare..." class="w-full border border-gray-200 rounded-lg px-3 py-2 focus:outline-pink-500">
                <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-pink-700 transition">Cari</button>
            </div>

            <div class="flex gap-2 overflow-x-auto w-full sm:w-auto pb-1 sm:pb-0">
                <a href="/kosmetik?category=All" class="px-3 py-1.5 rounded-lg border font-medium transition {{ ($selectedCategory == 'All' || !$selectedCategory) ? 'bg-pink-600 text-white border-pink-600' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">Semua</a>
                <a href="/kosmetik?category=Skincare" class="px-3 py-1.5 rounded-lg border font-medium transition {{ $selectedCategory == 'Skincare' ? 'bg-pink-600 text-white border-pink-600' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">Skincare</a>
                <a href="/kosmetik?category=Makeup" class="px-3 py-1.5 rounded-lg border font-medium transition {{ $selectedCategory == 'Makeup' ? 'bg-pink-600 text-white border-pink-600' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">Makeup</a>
            </div>
        </form>

        <!-- Daftar Produk Grid (Kotak Bergradasi Pink & Tombol Detail Berfungsi) -->
<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
    @forelse($products as $product)
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col justify-between">
        <div>
            <!-- Kotak Pengganti Gambar (Estetik & Menampilkan Nama/Kategori) -->
            <div class="h-36 bg-gradient-to-br from-pink-100 to-pink-200 flex flex-col items-center justify-center p-3 text-center border-b border-pink-50">
                <span class="text-[10px] font-bold text-pink-600 bg-white/90 px-2.5 py-1 rounded-full uppercase tracking-wider shadow-sm mb-2">
                    {{ $product['category'] }}
                </span>
                <span class="text-xs font-bold text-gray-800 line-clamp-2 px-2">
                    {{ $product['name'] }}
                </span>
            </div>

            <!-- Info Teks Harga -->
            <div class="p-3 space-y-1">
                <h3 class="font-bold text-gray-800 text-xs line-clamp-1">{{ $product['name'] }}</h3>
                <p class="text-pink-600 font-black text-xs">Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Tombol Aksi (Detail & Beli) -->
        <div class="p-3 pt-0 flex gap-2">
            <a href="/kosmetik/{{ $product['id'] }}" class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 py-1.5 rounded-lg text-xs font-semibold transition">
                Detail
            </a>
            <a href="/kosmetik/add-to-cart/{{ $product['id'] }}?qty=1" class="flex-1 text-center bg-pink-600 hover:bg-pink-700 text-white py-1.5 rounded-lg text-xs font-semibold transition">
                + Beli
            </a>
        </div>
    </div>
    @empty
    <div class="col-span-full bg-white rounded-xl p-8 text-center text-gray-400 text-xs shadow-sm">
        Produk yang kamu cari tidak ditemukan.
    </div>
    @endforelse
</div>