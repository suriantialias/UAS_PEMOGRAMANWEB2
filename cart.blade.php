<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - ANSHOPP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-700 min-h-screen p-6">

    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center bg-white p-4 rounded-2xl shadow-sm">
            <h1 class="text-lg font-black text-pink-600">🛒 Keranjang Belanja ANSHOPP</h1>
            <a href="/kosmetik" class="text-xs bg-gray-100 text-gray-700 px-3 py-1.5 rounded-lg font-medium hover:bg-gray-200">Kembali ke Katalog</a>
        </div>

        @if(isset($cartItems) && count($cartItems) > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Daftar Produk di Keranjang -->
                <div class="md:col-span-2 bg-white p-5 rounded-2xl shadow-sm space-y-4">
                    <h3 class="font-bold text-sm text-gray-800">Daftar Produk Pilihan</h3>
                    <div class="divide-y divide-gray-100">
                        @foreach($cartItems as $id => $item)
                            <div class="py-3 flex justify-between items-center text-xs">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $item['image'] ?? 'https://via.placeholder.com/50' }}" alt="" class="w-12 h-12 object-cover rounded-lg border">
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $item['name'] }}</p>
                                        <p class="text-gray-400">{{ $item['quantity'] ?? 1 }}x @ Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="font-bold text-pink-600">Rp {{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1), 0, ',', '.') }}</span>
                                    <a href="/kosmetik/remove-cart/{{ $id }}" class="text-red-500 font-bold hover:text-red-700 text-base px-2">×</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="pt-4 border-t border-gray-100 flex justify-between font-bold text-sm text-gray-800">
                        <span>Total Belanja:</span>
                        <span class="text-pink-600">Rp {{ number_format($totalPrice ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Form Checkout & Pilih Pembayaran -->
                <div>
                    <form action="/kosmetik/checkout" method="POST" class="bg-white p-5 rounded-2xl shadow-sm space-y-3">
                        @csrf
                        <h3 class="font-bold text-sm text-gray-800">📝 Data Checkout</h3>
                        
                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 mb-1">Nama Penerima</label>
                            <input type="text" name="nama" value="{{ session('username') }}" required class="w-full border border-gray-200 rounded-xl px-3 py-2 text-xs focus:outline-pink-500">
                        </div>

                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 mb-1">No Telepon / WhatsApp</label>
                            <input type="text" name="telepon" required placeholder="08xxxxxxxxxx" class="w-full border border-gray-200 rounded-xl px-3 py-2 text-xs focus:outline-pink-500">
                        </div>

                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 mb-1">Alamat Lengkap</label>
                            <textarea name="alamat" required rows="2" placeholder="Jalan, No Rumah, Kota..." class="w-full border border-gray-200 rounded-xl px-3 py-2 text-xs focus:outline-pink-500"></textarea>
                        </div>

                        <div>
                            <label class="block text-[11px] font-semibold text-gray-600 mb-1">Metode Pembayaran</label>
                            <select name="metode" required class="w-full border border-gray-200 rounded-xl px-3 py-2 text-xs bg-white focus:outline-pink-500 cursor-pointer">
                                <option value="QRIS">QRIS (Scan Barcode / E-Wallet)</option>
                                <option value="Transfer Bank (BCA)">Transfer BCA (123-456-7890)</option>
                                <option value="Transfer Bank (Mandiri)">Transfer Mandiri (987-654-3210)</option>
                                <option value="COD">COD (Bayar di Tempat)</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full bg-pink-600 text-white py-2.5 rounded-xl text-xs font-bold hover:bg-pink-700 transition shadow-sm">
                            Proses Pesanan 
                        </button>
                    </form>
                </div>

            </div>
        @else
            <div class="bg-white p-12 rounded-2xl text-center space-y-4 shadow-sm">
                <p class="text-gray-400 text-sm">Keranjang belanjaan kamu masih kosong.</p>
                <a href="/kosmetik" class="inline-block bg-pink-600 text-white px-5 py-2.5 rounded-xl text-xs font-bold hover:bg-pink-700 transition">Mulai Belanja Sekarang</a>
            </div>
        @endif

    </div>

</body>
</html>
