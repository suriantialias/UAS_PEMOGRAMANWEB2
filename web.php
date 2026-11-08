<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnshoppController;

Route::prefix('kosmetik')->group(function () {
    // Katalog & Beranda
    Route::get('/', [AnshoppController::class, 'index'])->name('kosmetik.index');
    
    // Login User / Customer
    Route::get('/login', [AnshoppController::class, 'showLogin'])->name('kosmetik.login');
    Route::post('/login', [AnshoppController::class, 'processLogin'])->name('kosmetik.processLogin');
    Route::get('/welcome', [AnshoppController::class, 'welcome'])->name('kosmetik.welcome');

    // Keranjang & Belanja Online
    Route::get('/cart', [AnshoppController::class, 'cart'])->name('kosmetik.cart');
    Route::match(['get', 'post'], '/add-to-cart/{id}', [AnshoppController::class, 'addToCart'])->name('kosmetik.cart.add');
    Route::post('/cart/remove/{id}', [AnshoppController::class, 'removeFromCart'])->name('kosmetik.cart.remove');
    Route::post('/checkout', [AnshoppController::class, 'storeCheckout'])->name('kosmetik.checkout');
    
    // Produk & Invoice Online
    Route::get('/product/{id}', [AnshoppController::class, 'show'])->name('kosmetik.show');
    Route::get('/invoice/{id}', function ($id) {
        $orders = session('orders', []);
        $order = collect($orders)->firstWhere('id', $id) ?? [
            'id' => $id, 
            'nama' => session('username', 'Tamu'), 
            'total' => 0, 
            'items' => [], 
            'tipe' => 'Online Web', 
            'metode' => 'COD', 
            'tanggal' => date('d M Y, H:i')
        ];
        return view('anshopp.invoice', compact('order'));
    })->name('kosmetik.invoice');

    // Owner / Admin Dashboard & Login
    Route::get('/owner/login', [AnshoppController::class, 'showOwnerLogin'])->name('kosmetik.owner.login');
    Route::post('/owner/login', [AnshoppController::class, 'processOwnerLogin'])->name('kosmetik.owner.processOwnerLogin');
    Route::get('/owner/dashboard', [AnshoppController::class, 'ownerDashboard'])->name('kosmetik.owner');
    Route::post('/owner/logout', [AnshoppController::class, 'ownerLogout'])->name('kosmetik.owner.logout');
    
    // Rute POS / Kasir Toko Offline Owner
    Route::post('/owner/pos/add', [AnshoppController::class, 'posAddToCart'])->name('kosmetik.owner.pos.add');
    Route::match(['get', 'post'], '/owner/pos/remove/{id}', [AnshoppController::class, 'posRemoveFromCart'])->name('kosmetik.owner.pos.remove');
    Route::post('/owner/pos/checkout', [AnshoppController::class, 'posCheckout'])->name('kosmetik.owner.pos.checkout');

    // Kontak
    Route::get('/contact', function () {
        return view('anshopp.contact');
    })->name('kosmetik.contact');
});