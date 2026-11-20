@extends('layouts.app')

@section('content')

<style>
    .cart-page {
        background: #f5f7fb;
        min-height: calc(100vh - 70px);
        padding: 35px;
    }

    .cart-container {
        max-width: 1100px;
        margin: auto;
    }

    .cart-header {
        background: linear-gradient(135deg, #062849, #164b78);
        color: white;
        padding: 30px;
        border-radius: 18px;
        margin-bottom: 25px;
    }

    .cart-header h1 {
        margin: 0 0 8px;
    }

    .cart-header p {
        margin: 0;
        opacity: .9;
    }

    .alert {
        padding: 14px 18px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .alert-success {
        background: #dff5e5;
        color: #1f6b35;
    }

    .alert-error {
        background: #fde2e2;
        color: #a52828;
    }

    .cart-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, .07);

        display: flex;
        align-items: center;
        gap: 20px;
    }

    .product-image {
        width: 100px;
        height: 100px;
        border-radius: 12px;
        overflow: hidden;
        background: #eef2f7;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .no-image {
        color: #888;
        font-size: 13px;
        text-align: center;
    }

    .product-info {
        flex: 1;
    }

    .product-name {
        font-size: 19px;
        font-weight: bold;
        color: #102f50;
        margin-bottom: 5px;
    }

    .product-code {
        color: #777;
        font-size: 13px;
        margin-bottom: 8px;
    }

    .product-price {
        color: #164b78;
        font-weight: bold;
    }

    .quantity-form {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .quantity-form input {
        width: 65px;
        padding: 8px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 7px;
    }

    .update-btn {
        border: none;
        background: #164b78;
        color: white;
        padding: 8px 12px;
        border-radius: 7px;
        cursor: pointer;
    }

    .remove-btn {
        border: none;
        background: #dc3545;
        color: white;
        padding: 9px 13px;
        border-radius: 7px;
        cursor: pointer;
    }

    .remove-btn:hover {
        background: #b02a37;
    }

    .cart-summary {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-top: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, .07);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .total-label {
        color: #555;
        font-size: 17px;
    }

    .total-price {
        color: #062849;
        font-size: 25px;
        font-weight: bold;
    }

    .checkout-btn {
        display: block;
        width: 100%;
        margin-top: 20px;
        padding: 13px;
        background: #062849;
        color: white;
        text-align: center;
        border: none;
        border-radius: 9px;
        text-decoration: none;
        font-size: 16px;
        cursor: pointer;
    }

    .checkout-btn:hover {
        background: #164b78;
        color: white;
    }

    .back-btn {
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 18px;
        background: white;
        color: #062849;
        text-decoration: none;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .back-btn:hover {
        background: #062849;
        color: white;
    }

    .empty-cart {
        background: white;
        padding: 60px 30px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, .07);
    }

    .empty-cart h2 {
        color: #102f50;
        margin-bottom: 10px;
    }

    .empty-cart p {
        color: #777;
        margin-bottom: 20px;
    }

    .shop-btn {
        display: inline-block;
        padding: 11px 20px;
        background: #062849;
        color: white;
        text-decoration: none;
        border-radius: 8px;
    }

    .shop-btn:hover {
        background: #164b78;
        color: white;
    }

    @media (max-width: 700px) {
        .cart-page {
            padding: 20px;
        }

        .cart-card {
            flex-direction: column;
            align-items: stretch;
        }

        .product-image {
            width: 100%;
            height: 180px;
        }

        .quantity-form {
            justify-content: space-between;
        }

        .summary-row {
            gap: 15px;
        }
    }
</style>

<div class="cart-page">

    <div class="cart-container">

        <a href="{{ route('customer.home') }}" class="back-btn">
            ← Kembali ke Produk
        </a>

        <div class="cart-header">
            <h1>Keranjang Belanja</h1>

            <p>
                Produk yang kamu pilih akan muncul di sini.
            </p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if(count($cart) > 0)

            @foreach($cart as $item)

                <div class="cart-card">

                    <div class="product-image">

                        @if(!empty($item['image']))
                            <img
                                src="{{ asset('storage/' . $item['image']) }}"
                                alt="{{ $item['name'] }}"
                            >
                        @else
                            <div class="no-image">
                                Tidak ada gambar
                            </div>
                        @endif

                    </div>

                    <div class="product-info">

                        <div class="product-name">
                            {{ $item['name'] }}
                        </div>

                        @if(!empty($item['product_code']))
                            <div class="product-code">
                                Kode: {{ $item['product_code'] }}
                            </div>
                        @endif

                        @if(!empty($item['brand']))
                            <div class="product-code">
                                Brand: {{ $item['brand'] }}
                            </div>
                        @endif

                        <div class="product-price">
                            Rp {{ number_format($item['price'], 0, ',', '.') }}
                        </div>

                    </div>

                    <form
                        action="{{ route('customer.cart.update', $item['id']) }}"
                        method="POST"
                        class="quantity-form"
                    >

                        @csrf
                        @method('PATCH')

                        <input
                            type="number"
                            name="quantity"
                            value="{{ $item['quantity'] }}"
                            min="1"
                        >

                        <button type="submit" class="update-btn">
                            Update
                        </button>

                    </form>

                    <div style="min-width: 150px; text-align: right;">

                        <strong style="color:#102f50;">
                            Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                        </strong>

                        <form
                            action="{{ route('customer.cart.remove', $item['id']) }}"
                            method="POST"
                            style="margin-top:10px;"
                        >

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="remove-btn">
                                Hapus
                            </button>

                        </form>

                    </div>

                </div>

            @endforeach

            <div class="cart-summary">

                <div class="summary-row">

                    <div class="total-label">
                        Total Belanja
                    </div>

                    <div class="total-price">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </div>

                </div>

                <button
                    type="button"
                    class="checkout-btn"
                    onclick="alert('Fitur checkout akan kita buat setelah keranjang selesai.')"
                >
                    Checkout
                </button>

            </div>

        @else

            <div class="empty-cart">

                <h2>Keranjang Masih Kosong</h2>

                <p>
                    Kamu belum menambahkan produk ke keranjang.
                </p>

                <a href="{{ route('customer.home') }}" class="shop-btn">
                    Mulai Belanja
                </a>

            </div>

        @endif

    </div>

</div>

@endsection