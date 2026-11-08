<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pesanan - ANSHOPP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { background: white; padding: 0; }
            .no-print { display: none; }
            .invoice-box { border: none; shadow: none; padding: 0; }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans text-gray-700 min-h-screen py-10">

    <div class="max-w-xl mx-auto bg-white p-8 rounded-2xl border border-gray-200 shadow-sm space-y-6 invoice-box">
        
        <!-- Header Nota -->
        <div class="text-center border-b border-gray-100 pb-4">
            <h1 class="text-xl font-black text-pink-600 tracking-wide">ANSHOPP STORE</h1>
            <p class="text-xs text-gray-400">Bukti Pesanan & Panduan Pembayaran</p>
            <span class="inline-block mt-2 bg-green-50 text-green-600 px-3 py-1 rounded-full text-[11px] font-bold">
                Status: {{ $order['status'] ?? 'Pending' }}
            </span>
        </div>

        <!-- Detail Transaksi -->
        <div class="grid grid-cols-2 gap-4 text-xs">
            <div>
                <p class="text-gray-400">ID Transaksi:</p>
                <p class="font-bold text-gray-800">{{ $order['id'] ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-400">Tanggal:</p>
                <p class="font-bold text-gray-800">{{ $order['tanggal'] ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-400">Nama Pemesan:</p>
                <p class="font-bold text-gray-800">{{ $order['nama'] ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-400">Metode Pembayaran:</p>
                <p class="font-bold text-pink-600">{{ $order['metode'] ?? 'COD' }}</p>
            </div>
        </div>

        <!-- Instruksi Pembayaran / QRIS / TF / Tunai -->
    <div class="bg-pink-50/60 border border-pink-100 p-4 rounded-xl space-y-2 text-xs">
        <p class="font-bold text-pink-700">💡 Panduan Pembayaran:</p>
        
        @if(isset($order['metode']) && stripos($order['metode'], 'QRIS') !== false)
            <p class="text-gray-600">Scan QR Code di bawah ini menggunakan aplikasi e-wallet atau m-banking:</p>
            <div class="flex justify-center py-2">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $order['id'] }}" alt="QRIS Barcode" class="w-28 h-28 bg-white p-1 border rounded shadow-sm">
            </div>
            <p class="text-center font-bold text-gray-800">Total: Rp {{ number_format($order['total'] ?? 0, 0, ',', '.') }}</p>
        
        @elseif(isset($order['metode']) && (stripos($order['metode'], 'Transfer') !== false || stripos($order['metode'], 'TF') !== false))
            <p class="text-gray-600">Silakan transfer senilai <b class="text-gray-800">Rp {{ number_format($order['total'] ?? 0, 0, ',', '.') }}</b> ke rekening berikut:</p>
            <div class="bg-white p-3 rounded-lg border border-pink-200 text-center font-bold text-gray-800 shadow-sm">
                Bank BCA: <span class="text-pink-600 text-sm">123-456-7890</span><br>
                <span class="text-[11px] text-gray-500 font-normal">a.n. Anshopp Official Store</span>
            </div>
        
        @else
            <p class="text-gray-600">Pesanan menggunakan metode <b>Cash / Tunai</b>. Silakan lakukan pembayaran langsung di kasir toko.</p>
        @endif
    </div>

        <!-- Rincian Produk -->
        <div class="space-y-3">
            <p class="text-xs font-bold text-gray-800">Rincian Item:</p>
            <div class="divide-y divide-gray-100 border border-gray-100 rounded-xl p-3">
                @foreach($order['items'] ?? [] as $item)
                    <div class="py-2 flex justify-between items-center text-xs">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $item['name'] ?? '-' }}</p>
                            <p class="text-[10px] text-gray-400">{{ $item['quantity'] ?? 1 }}x @ Rp {{ number_format($item['price'] ?? 0, 0, ',', '.') }}</p>
                        </div>
                        <span class="font-bold text-gray-800">Rp {{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 1), 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>
            
            <div class="flex justify-between items-center pt-2 font-bold text-sm text-gray-800 border-t border-gray-100">
                <span>Total Pembayaran:</span>
                <span class="text-pink-600 text-base">Rp {{ number_format($order['total'] ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Tombol Aksi Kondisional (Customer Online vs Owner POS) -->
        <div class="flex gap-3 pt-4 no-print">
            @if(str_contains($order['id'] ?? '', 'POS'))
                <!-- Tombol Khusus Kasir / Owner Offline -->
                <a href="/kosmetik/owner/dashboard" class="flex-1 bg-gray-100 text-center text-gray-700 py-2.5 rounded-xl text-xs font-bold hover:bg-gray-200 transition">
                    Kembali ke Dashboard
                </a>
                <button onclick="window.print()" class="flex-1 bg-pink-600 text-center text-white py-2.5 rounded-xl text-xs font-bold hover:bg-pink-700 transition shadow-sm">
                    Cetak Struk Nota 🖨️
                </button>
            @else
                <!-- Tombol Khusus Customer Online -->
                <a href="/kosmetik" class="flex-1 bg-gray-100 text-center text-gray-700 py-2.5 rounded-xl text-xs font-bold hover:bg-gray-200 transition">
                    Kembali
                </a>
                <a href="/kosmetik" class="flex-1 bg-pink-600 text-center text-white py-2.5 rounded-xl text-xs font-bold hover:bg-pink-700 transition shadow-sm">
                    Selesai ✅
                </a>
            @endif
        </div>

    </div>

</body>
</html>