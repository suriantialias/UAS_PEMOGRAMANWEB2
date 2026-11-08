<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Owner - Anshopp Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <!-- Navbar Owner -->
    <nav class="bg-white shadow border-b px-6 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <span class="text-xl font-extrabold text-pink-600">ANSHOPP OWNER</span>
            <span class="text-xs bg-pink-100 text-pink-600 px-2 py-1 rounded-full font-semibold">Admin Panel</span>
        </div>
        <form action="{{ route('kosmetik.owner.logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-sm font-bold px-4 py-2 rounded shadow transition">
                Logout
            </button>
        </form>
    </nav>

    <div class="container mx-auto px-6 py-8">
        <!-- Statistik Singkat -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow border border-gray-100 flex items-center">
                <div class="p-3 bg-pink-50 text-pink-600 rounded-lg text-2xl mr-4">💰</div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Omset</p>
                    <h3 class="text-2xl font-bold text-gray-800">Rp {{ number_format($totalOmset, 0, ',', '.') }}</h3>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow border border-gray-100 flex items-center">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-lg text-2xl mr-4">📦</div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Transaksi</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $totalTransaksi }} Pesanan</h3>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow border border-gray-100 flex items-center">
                <div class="p-3 bg-green-50 text-green-600 rounded-lg text-2xl mr-4">🛍️</div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Katalog Produk</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ count($products ?? []) }} Item</h3>
                </div>
            </div>
        </div>

        <!-- Grid Utama: Kasir POS (Kiri) & Riwayat Transaksi/Stok (Kanan) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Kolom Kiri: Kasir POS Offline -->
            <div class="bg-white p-6 rounded-xl shadow border border-gray-100 lg:col-span-1 h-fit">
                <h3 class="font-bold text-gray-800 text-lg mb-4 flex items-center gap-2">
                    <span>🛒</span> Kasir Offline (POS Toko)
                </h3>

                <!-- Form Tambah Item -->
                <form action="{{ route('kosmetik.owner.pos.add') }}" method="POST" class="mb-6 bg-gray-50 p-4 rounded-lg border">
                    @csrf
                    <div class="mb-3">
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Pilih Produk</label>
                        <select name="product_id" class="w-full border border-gray-300 rounded-lg p-2 text-sm bg-white focus:ring-2 focus:ring-pink-500 outline-none" required>
                            <option value="">-- Pilih Produk Kosmetik --</option>
                            @foreach(($products ?? []) as $p)
                                <option value="{{ $p['id'] }}">{{ $p['name'] }} (Stok: {{ $p['stock'] }} | Rp {{ number_format($p['price'], 0, ',', '.') }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Qty</label>
                        <input type="number" name="qty" value="1" min="1" class="w-full border border-gray-300 rounded-lg p-2 text-sm bg-white focus:ring-2 focus:ring-pink-500 outline-none" required>
                    </div>
                    <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white font-bold py-2.5 rounded-lg text-sm shadow transition">
                        + Tambah ke Keranjang
                    </button>
                </form>

                <!-- Daftar Belanjaan Saat Ini -->
                <div>
                    <p class="text-xs font-bold text-gray-700 mb-2">Daftar Belanjaan Saat Ini:</p>
                    @if(isset($posCart) && count($posCart) > 0)
                        @php $posTotal = 0; @endphp
                        <div class="divide-y divide-gray-100 border border-gray-100 rounded-xl p-2 max-h-48 overflow-y-auto space-y-2 mb-3">
                            @foreach($posCart as $id => $item)
                                @php 
                                    $qty = $item['quantity'] ?? $item['qty'] ?? 1;
                                    $price = $item['price'] ?? 0;
                                    $subtotal = $price * $qty;
                                    $posTotal += $subtotal;
                                @endphp
                                <div class="py-2 flex justify-between items-center text-xs">
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $item['name'] ?? 'Produk' }}</p>
                                        <p class="text-[10px] text-gray-400">{{ $qty }}x @ Rp {{ number_format($price, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="font-bold text-pink-600">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                                        <a href="{{ route('kosmetik.owner.pos.remove', $id) }}" class="text-red-500 font-extrabold hover:text-red-700 text-base" title="Hapus">&times;</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex justify-between items-center pt-2 font-bold text-xs text-gray-800 border-t mb-4">
                            <span>Total Belanja:</span>
                            <span class="text-pink-600 text-sm">Rp {{ number_format($posTotal ?? 0, 0, ',', '.') }}</span>
                        </div>

                        <!-- Form Selesaikan Transaksi dengan Pilihan Pembayaran -->
                        <form action="{{ route('kosmetik.owner.pos.checkout') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Nama Pembeli</label>
                                <input type="text" name="nama_pembeli" placeholder="Nama Customer / Umum" class="w-full border border-gray-300 rounded-lg p-2 text-xs bg-white focus:ring-2 focus:ring-pink-500 outline-none">
                            </div>

                            <div class="mb-3">
                                <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Metode Pembayaran</label>
                                <select name="metode" class="w-full border border-gray-300 rounded-lg p-2 text-xs bg-white focus:ring-2 focus:ring-pink-500 outline-none" required>
                                    <option value="Cash">Tunai / Cash</option>
                                    <option value="QRIS">QRIS (Scan Barcode)</option>
                                    <option value="Transfer Bank">Transfer Bank</option>
                                </select>
                            </div>

                            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2.5 rounded-lg text-sm shadow transition">
                                Proses Bayar & Selesai ⚡
                            </button>
                        </form>
                    @else
                        <div class="text-center py-6 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                            <p class="text-xs text-gray-400 italic">Keranjang kasir masih kosong.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Kolom Kanan: Riwayat Transaksi & Manajemen Stok -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Riwayat Transaksi -->
                <div class="bg-white p-6 rounded-xl shadow border border-gray-100">
                    <h3 class="font-bold text-gray-800 text-lg mb-4 flex items-center gap-2">
                        <span>📋</span> Riwayat Transaksi Terbaru
                    </h3>
                    @if(empty($orders))
                        <p class="text-xs text-gray-400 italic">Belum ada transaksi yang tercatat.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs">
                                <thead>
                                    <tr class="bg-gray-50 border-b text-gray-600">
                                        <th class="p-3">ID / Tipe</th>
                                        <th class="p-3">Pembeli</th>
                                        <th class="p-3">Metode</th>
                                        <th class="p-3">Total</th>
                                        <th class="p-3 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="p-3">
                                            <span class="font-bold text-gray-800">{{ $order['id'] }}</span>
                                            <span class="block text-[10px] text-gray-400">{{ $order['tipe'] ?? 'Online' }}</span>
                                        </td>
                                        <td class="p-3">{{ $order['nama'] }}</td>
                                        <td class="p-3"><span class="px-2 py-1 bg-gray-100 rounded text-gray-700 font-semibold">{{ $order['metode'] ?? 'Cash' }}</span></td>
                                        <td class="p-3 font-bold text-pink-600">Rp {{ number_format($order['total'], 0, ',', '.') }}</td>
                                        <td class="p-3 text-center">
                                            <a href="{{ route('kosmetik.invoice', $order['id']) }}" target="_blank" class="bg-blue-50 text-blue-600 hover:bg-blue-100 px-3 py-1 rounded font-semibold transition">
                                                Nota
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <!-- Manajemen Stok Produk -->
                <div class="bg-white p-6 rounded-xl shadow border border-gray-100">
                    <h3 class="font-bold text-gray-800 text-lg mb-4 flex items-center gap-2">
                        <span>📦</span> Stok Produk Toko
                    </h3>
                    <div class="overflow-x-auto max-h-72 overflow-y-auto">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="bg-gray-50 border-b text-gray-600 sticky top-0">
                                    <th class="p-3">Nama Produk</th>
                                    <th class="p-3">Kategori</th>
                                    <th class="p-3">Harga</th>
                                    <th class="p-3 text-center">Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach(($products ?? []) as $p)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-3 font-medium text-gray-800">{{ $p['name'] }}</td>
                                    <td class="p-3 text-gray-500">{{ $p['category'] }}</td>
                                    <td class="p-3">Rp {{ number_format($p['price'], 0, ',', '.') }}</td>
                                    <td class="p-3 text-center">
                                        <span class="px-2 py-1 rounded font-bold {{ $p['stock'] <= 5 ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                                            {{ $p['stock'] }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>