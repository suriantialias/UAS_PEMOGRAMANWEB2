<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnshoppController extends Controller
{
  public function getProducts()
{
    $defaultProducts = [
        ['id' => 1, 'name' => 'Glad2Glow Blueberry 5% Ceramide Moisturizer 30g', 'category' => 'Skincare', 'price' => 45000, 'stock' => 15],
        ['id' => 2, 'name' => 'OMG Oh My Glam Matte Kiss Lip Cream', 'category' => 'Makeup', 'price' => 25000, 'stock' => 20],
        ['id' => 3, 'name' => 'Glad2Glow Centella Soothing Gel Moisturizer', 'category' => 'Skincare', 'price' => 42000, 'stock' => 25],
        ['id' => 4, 'name' => 'Hanasui Mattedorable Lip Cream Boba Edition', 'category' => 'Makeup', 'price' => 28000, 'stock' => 18],
        ['id' => 5, 'name' => 'Skintific 5X Ceramide Barrier Repair Moisturizer', 'category' => 'Skincare', 'price' => 135000, 'stock' => 10],
        ['id' => 6, 'name' => 'The Originote Hyalucera Moisturizer 50ml', 'category' => 'Skincare', 'price' => 42000, 'stock' => 30],
        ['id' => 7, 'name' => 'Azarine Hydrasoothe Sunscreen Gel SPF 45 PA++++', 'category' => 'Skincare', 'price' => 65000, 'stock' => 12],
        ['id' => 8, 'name' => 'Wardah Colorfit Velvet Matte Lip Mousse', 'category' => 'Makeup', 'price' => 60000, 'stock' => 15],
        ['id' => 9, 'name' => 'Somethinc Niacinamide + Moisture Beet Serum', 'category' => 'Skincare', 'price' => 115000, 'stock' => 8],
        ['id' => 10, 'name' => 'Emina Bright Stuff Moisturizing Cream', 'category' => 'Skincare', 'price' => 22000, 'stock' => 40],
        ['id' => 11, 'name' => 'Skintific All Day Light Sunscreen Mist SPF50+', 'category' => 'Skincare', 'price' => 120000, 'stock' => 10],
        ['id' => 12, 'name' => 'Glad2Glow Mugwort Salicylic Acid Acne Clay Mask', 'category' => 'Skincare', 'price' => 38000, 'stock' => 22],
        ['id' => 13, 'name' => 'The Originote Acne B5 Serum', 'category' => 'Skincare', 'price' => 38000, 'stock' => 25],
        ['id' => 14, 'name' => 'Wardah Lightening Liquid Foundation', 'category' => 'Makeup', 'price' => 45000, 'stock' => 14],
        ['id' => 15, 'name' => 'Hanasui Power Bright Serum', 'category' => 'Skincare', 'price' => 26000, 'stock' => 20],
        ['id' => 16, 'name' => 'Make Over Powerstay Matte Powder Foundation', 'category' => 'Makeup', 'price' => 175000, 'stock' => 12],
        ['id' => 17, 'name' => 'Pixy Aqua Beauty Protecting Mist', 'category' => 'Skincare', 'price' => 30000, 'stock' => 25],
        ['id' => 18, 'name' => 'Emina Sun Battle SPF 30 PA+++', 'category' => 'Skincare', 'price' => 29000, 'stock' => 35],
        ['id' => 19, 'name' => 'Wardah EyeXpert Optimum Hi-Black Liner', 'category' => 'Makeup', 'price' => 75000, 'stock' => 18],
        ['id' => 20, 'name' => 'Skintific 10% Vitamin C Brightening Glow Serum', 'category' => 'Skincare', 'price' => 130000, 'stock' => 10],
        ['id' => 21, 'name' => 'The Originote Cica-B5 Soothing Facial Cleanser', 'category' => 'Skincare', 'price' => 38000, 'stock' => 28],
        ['id' => 22, 'name' => 'Hanasui Tinted Amoeba Lip Stain', 'category' => 'Makeup', 'price' => 23000, 'stock' => 20],
        ['id' => 23, 'name' => 'Madame Gie Madame To Go Makeup Palette', 'category' => 'Makeup', 'price' => 35000, 'stock' => 15],
        ['id' => 24, 'name' => 'Implora Cheek & Liptint', 'category' => 'Makeup', 'price' => 10000, 'stock' => 50],
        ['id' => 25, 'name' => 'Azarine Cicamide Barrier Sunscreen Moisturizer', 'category' => 'Skincare', 'price' => 68000, 'stock' => 16],
        ['id' => 26, 'name' => 'Wardah Perfect Bright Creamy Foam', 'category' => 'Skincare', 'price' => 27000, 'stock' => 30],
        ['id' => 27, 'name' => 'Skintific 2% Salicylic Acid Anti Acne Serum', 'category' => 'Skincare', 'price' => 125000, 'stock' => 12],
        ['id' => 28, 'name' => 'Emina Glossy Stain Lip Gloss', 'category' => 'Makeup', 'price' => 45000, 'stock' => 22],
        ['id' => 29, 'name' => 'Glad2Glow Pomegranate 5% Niacinamide Brightening Moisturizer', 'category' => 'Skincare', 'price' => 45000, 'stock' => 25],
        ['id' => 30, 'name' => 'The Originote Hyaluron Pad Exfoliating Toner', 'category' => 'Skincare', 'price' => 65000, 'stock' => 14],
    ];

    session(['products' => $defaultProducts]);
    return session('products');
}
    public function showLogin()
    {
        return view('anshopp.login');
    }

    public function processLogin(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        session(['username' => $request->name]);
        return redirect()->route('kosmetik.welcome');
    }

    public function welcome()
    {
        $username = session('username', 'Beauty');
        return view('anshopp.welcome', compact('username'));
    }

    public function index(Request $request)
    {
        if (!session()->has('username')) {
            return redirect()->route('kosmetik.login');
        }

        $search = $request->input('search');
        $category = $request->input('category');
        $products = collect($this->getProducts());

        if ($search) {
            $products = $products->filter(fn($item) => stripos($item['name'], $search) !== false);
        }
        if ($category && $category !== 'All') {
            $products = $products->filter(fn($item) => $item['category'] === $category);
        }

        return view('anshopp.index', ['products' => $products, 'search' => $search, 'selectedCategory' => $category]);
    }

    public function show($id)
    {
        $product = collect($this->getProducts())->firstWhere('id', (int)$id);
        if (!$product) abort(404);
        return view('anshopp.show', compact('product'));
    }

    public function addToCart(Request $request, $id)
    {
        $products = $this->getProducts();
        $product = collect($products)->firstWhere('id', (int)$id);
        if (!$product) return redirect()->back();

        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += 1;
        } else {
            $cart[$id] = $product;
            $cart[$id]['quantity'] = 1;
        }
        session()->put('cart', $cart);
        return redirect()->back();
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back();
    }

    public function cart()
    {
        $cartItems = session()->get('cart', []);
        $totalPrice = collect($cartItems)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('anshopp.cart', compact('cartItems', 'totalPrice'));
    }

    public function storeCheckout(Request $request)
    {
        $cartItems = session()->get('cart', []);
        if (empty($cartItems)) return redirect()->route('kosmetik.cart');

        $products = $this->getProducts();
        $totalPrice = 0;

        foreach ($cartItems as $id => $item) {
            $totalPrice += ($item['price'] * $item['quantity']);
            foreach ($products as &$p) {
                if ($p['id'] == $id) {
                    $p['stock'] = max(0, $p['stock'] - $item['quantity']);
                }
            }
        }
        session(['products' => $products]);

        $order = [
            'id' => 'TRX-' . rand(10000, 99999),
            'nama' => $request->input('nama', session('username', 'Tamu')),
            'telepon' => $request->input('telepon', '-'),
            'alamat' => $request->input('alamat', '-'),
            'metode' => $request->input('metode', 'COD'),
            'tipe' => 'Online Web',
            'status' => 'Selesai',
            'items' => $cartItems,
            'total' => $totalPrice,
            'tanggal' => date('d M Y, H:i')
        ];

        $orders = session()->get('orders', []);
        array_unshift($orders, $order);
        session(['orders' => $orders]);
        session()->forget('cart');

        return view('anshopp.invoice', compact('order'));
    }

    public function showOwnerLogin()
    {
        return view('anshopp.owner_login');
    }

    public function processOwnerLogin(Request $request)
    {
        if ($request->password === 'admin123') {
            session(['is_owner' => true]);
            return redirect()->route('kosmetik.owner');
        }
        return redirect()->back()->with('error', 'Password Owner salah!');
    }

    public function ownerLogout()
    {
        session()->forget('is_owner');
        return redirect()->route('kosmetik.owner.login');
    }

    public function ownerDashboard()
{
    if (!session()->has('is_owner')) {
        return redirect()->route('kosmetik.owner.login');
    }
    
    // Ubah baris 191 menjadi pemanggilan data aman seperti ini:
    $products = method_exists($this, 'getProducts') ? $this->getProducts() : [];
    
    $orders = session()->get('orders', []);
    $posCart = session()->get('pos_cart', []);

    $totalOmset = collect($orders)->sum(fn($o) => $o['total'] ?? 0);
    $totalTransaksi = count($orders);

    return view('anshopp.owner', compact('products', 'orders', 'posCart', 'totalOmset', 'totalTransaksi'));
}
    // 1. Tambah item ke keranjang kasir POS
    public function posAddToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $qty = (int)$request->input('qty', 1);

        $products = $this->getProducts();
        $product = collect($products)->firstWhere('id', (int)$productId);
        if (!$product) return redirect()->back();

        $posCart = session()->get('pos_cart', []);
        
        if (isset($posCart[$productId])) {
            $posCart[$productId]['quantity'] += $qty;
        } else {
            $posCart[$productId] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $qty
            ];
        }

        session()->put('pos_cart', $posCart);
        return redirect()->route('kosmetik.owner');
    }

    // 2. Hapus item dari keranjang kasir POS
    public function posRemoveFromCart($id)
    {
        $posCart = session()->get('pos_cart', []);
        if (isset($posCart[$id])) {
            unset($posCart[$id]);
            session()->put('pos_cart', $posCart);
        }
        return redirect()->route('kosmetik.owner');
    }

    // 3. Proses Checkout kasir POS offline & langsung buka struk
    public function posCheckout(Request $request)
    {
        $posCart = session()->get('pos_cart', []);
        if (empty($posCart)) return redirect()->route('kosmetik.owner');

        $products = $this->getProducts();
        $totalPrice = 0;

        foreach ($posCart as $id => $item) {
            $totalPrice += ($item['price'] * $item['quantity']);
            foreach ($products as &$p) {
                if ($p['id'] == $id) {
                    $p['stock'] = max(0, $p['stock'] - $item['quantity']);
                }
            }
        }
        session(['products' => $products]);

        $metode = $request->input('metode', 'Cash');

        $order = [
            'id' => 'POS-' . rand(10000, 99999),
            'nama' => $request->input('nama_pembeli', 'Kasir Toko (Offline)'),
            'telepon' => '-',
            'alamat' => 'Toko Fisik',
            'metode' => $metode,
            'tipe' => 'Kasir Offline',
            'status' => 'Selesai',
            'items' => $posCart,
            'total' => $totalPrice,
            'tanggal' => date('d M Y, H:i')
        ];

        $orders = session()->get('orders', []);
        array_unshift($orders, $order);
        session(['orders' => $orders]);
        session()->forget('pos_cart'); // Kosongkan keranjang kasir

        return view('anshopp.invoice', compact('order'));
    }
}
