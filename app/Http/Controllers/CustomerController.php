<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | CUSTOMER
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->get();

        return view('customer.home', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load('category');

        return view('customer.detail', compact('product'));
    }


    /*
    |--------------------------------------------------------------------------
    | CART
    |--------------------------------------------------------------------------
    */

    public function cart()
    {
        $cart = session()->get('cart', []);

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('customer.cart', compact('cart', 'total'));
    }

    public function addToCart(Request $request, Product $product)
    {
        $quantity = (int) $request->input('quantity', 1);

        if ($quantity < 1) {
            $quantity = 1;
        }

        if ($product->stock < $quantity) {
            return back()->with(
                'error',
                'Stok produk tidak mencukupi.'
            );
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {

            $newQuantity =
                $cart[$product->id]['quantity'] + $quantity;

            if ($newQuantity > $product->stock) {
                return back()->with(
                    'error',
                    'Jumlah melebihi stok yang tersedia.'
                );
            }

            $cart[$product->id]['quantity'] = $newQuantity;

        } else {

            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'product_code' => $product->product_code,
                'brand' => $product->brand,
                'price' => (float) $product->price,
                'image' => $product->image,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()
            ->route('customer.cart')
            ->with(
                'success',
                'Produk berhasil ditambahkan ke keranjang.'
            );
    }

    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return back()->with(
                'error',
                'Produk tidak ditemukan di keranjang.'
            );
        }

        $quantity = (int) $request->input('quantity');

        if ($quantity < 1) {

            unset($cart[$id]);

        } else {

            $product = Product::find($id);

            if (!$product) {

                unset($cart[$id]);

            } elseif ($quantity > $product->stock) {

                return back()->with(
                    'error',
                    'Jumlah melebihi stok yang tersedia.'
                );

            } else {

                $cart[$id]['quantity'] = $quantity;
            }
        }

        session()->put('cart', $cart);

        return back()->with(
            'success',
            'Keranjang berhasil diperbarui.'
        );
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return back()->with(
            'success',
            'Produk berhasil dihapus dari keranjang.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CHECKOUT
    |--------------------------------------------------------------------------
    */

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('customer.cart')
                ->with(
                    'error',
                    'Keranjang masih kosong.'
                );
        }

        $total = 0;

        foreach ($cart as $item) {
            $total +=
                $item['price'] * $item['quantity'];
        }

        return view(
            'customer.checkout',
            compact('cart', 'total')
        );
    }

    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('customer.cart')
                ->with(
                    'error',
                    'Keranjang masih kosong.'
                );
        }

        $total = 0;

        foreach ($cart as $item) {
            $total +=
                $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'total' => $total,
            'status' => 'pending',
        ]);

        foreach ($cart as $item) {

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'subtotal' =>
                    $item['price'] * $item['quantity'],
            ]);

            $product = Product::find($item['id']);

            if ($product) {
                $product->decrement(
                    'stock',
                    $item['quantity']
                );
            }
        }

        session()->forget('cart');

        return redirect()
            ->route('customer.orders')
            ->with(
                'success',
                'Pesanan berhasil dibuat.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | RIWAYAT PESANAN CUSTOMER
    |--------------------------------------------------------------------------
    */

    public function orders()
    {
        $orders = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view(
            'customer.orders',
            compact('orders')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN - KELOLA PESANAN
    |--------------------------------------------------------------------------
    */

    public function adminOrders()
    {
        $orders = Order::with([
            'user',
            'items.product'
        ])
            ->latest()
            ->get();

        return view(
            'admin.orders',
            compact('orders')
        );
    }

    public function updateOrderStatus(
        Request $request,
        Order $order
    ) {
        $request->validate([
            'status' => [
                'required',
                'in:pending,diproses,selesai,dibatalkan'
            ],
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return back()->with(
            'success',
            'Status pesanan berhasil diperbarui.'
        );
    }
}