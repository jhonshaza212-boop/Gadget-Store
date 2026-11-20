@extends('layouts.app')

@section('content')

<style>
    .checkout-container {
        max-width: 1100px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .checkout-title {
        color: #102f50;
        margin-bottom: 25px;
    }

    .checkout-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 25px;
    }

    .checkout-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }

    .checkout-card h3 {
        color: #102f50;
        margin-bottom: 20px;
    }

    .product-item {
        display: flex;
        gap: 15px;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }

    .product-item:last-child {
        border-bottom: none;
    }

    .product-image {
        width: 80px;
        height: 80px;
        border-radius: 10px;
        object-fit: cover;
        background: #f1f1f1;
    }

    .product-info {
        flex: 1;
    }

    .product-name {
        font-weight: bold;
        color: #102f50;
        margin-bottom: 5px;
    }

    .product-detail {
        color: #666;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .product-price {
        font-weight: bold;
        color: #062849;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        color: #555;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        border-top: 1px solid #ddd;
        padding-top: 20px;
        margin-top: 20px;
        font-size: 20px;
        font-weight: bold;
        color: #102f50;
    }

    .checkout-button {
        display: block;
        width: 100%;
        border: none;
        background: #062849;
        color: white;
        padding: 14px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        margin-top: 25px;
        text-align: center;
    }

    .checkout-button:hover {
        background: #0d3d6b;
    }

    .back-button {
        display: inline-block;
        margin-top: 15px;
        color: #062849;
        text-decoration: none;
    }

    .back-button:hover {
        text-decoration: underline;
    }

    .empty-message {
        text-align: center;
        padding: 30px;
        color: #666;
    }

    @media (max-width: 768px) {
        .checkout-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="checkout-container">

    <h1 class="checkout-title">
        Checkout
    </h1>

    @if(session('error'))
        <div style="
            background: #f8d7da;
            color: #842029;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        ">
            {{ session('error') }}
        </div>
    @endif

    <div class="checkout-grid">

        {{-- DAFTAR PRODUK --}}
        <div class="checkout-card">

            <h3>Detail Pesanan</h3>

            @foreach($cart as $item)

                <div class="product-item">

                    @if(!empty($item['image']))
                        <img
                            src="{{ asset('storage/' . $item['image']) }}"
                            alt="{{ $item['name'] }}"
                            class="product-image"
                        >
                    @else
                        <div class="product-image"></div>
                    @endif

                    <div class="product-info">

                        <div class="product-name">
                            {{ $item['name'] }}
                        </div>

                        <div class="product-detail">
                            Kode: {{ $item['product_code'] }}
                        </div>

                        @if(!empty($item['brand']))
                            <div class="product-detail">
                                Brand: {{ $item['brand'] }}
                            </div>
                        @endif

                        <div class="product-detail">
                            Jumlah: {{ $item['quantity'] }}
                        </div>

                        <div class="product-price">
                            Rp {{ number_format($item['price'], 0, ',', '.') }}
                        </div>

                    </div>

                    <div style="font-weight: bold;">
                        Rp {{ number_format(
                            $item['price'] * $item['quantity'],
                            0,
                            ',',
                            '.'
                        ) }}
                    </div>

                </div>

            @endforeach

        </div>


        {{-- RINGKASAN --}}
        <div class="checkout-card">

            <h3>Ringkasan Pembayaran</h3>

            @foreach($cart as $item)

                <div class="summary-row">

                    <span>
                        {{ $item['name'] }}
                        × {{ $item['quantity'] }}
                    </span>

                    <span>
                        Rp {{ number_format(
                            $item['price'] * $item['quantity'],
                            0,
                            ',',
                            '.'
                        ) }}
                    </span>

                </div>

            @endforeach

            <div class="total-row">

                <span>Total</span>

                <span>
                    Rp {{ number_format($total, 0, ',', '.') }}
                </span>

            </div>


            {{-- FORM PESANAN --}}
            <form
                action="{{ route('customer.checkout.place') }}"
                method="POST"
            >
                @csrf

                <button
                    type="submit"
                    class="checkout-button"
                >
                    Konfirmasi Pesanan
                </button>
            </form>


            <a
                href="{{ route('customer.cart') }}"
                class="back-button"
            >
                ← Kembali ke Keranjang
            </a>

        </div>

    </div>

</div>

@endsection