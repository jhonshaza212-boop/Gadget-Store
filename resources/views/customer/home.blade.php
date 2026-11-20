@extends('layouts.app')

@section('content')

<style>
    * {
        box-sizing: border-box;
    }

    body {
        background: #f5f7fb;
    }

    .store-wrapper {
        max-width: 1400px;
        margin: 0 auto;
        padding: 30px;
    }

    /* HERO */
    .hero {
        min-height: 350px;
        border-radius: 24px;
        padding: 45px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        overflow: hidden;
        position: relative;
        background:
            linear-gradient(135deg, #071d35 0%, #0c3d68 55%, #1677b8 100%);
        color: white;
        box-shadow: 0 15px 40px rgba(10, 50, 90, 0.18);
    }

    .hero::before {
        content: "";
        position: absolute;
        width: 350px;
        height: 350px;
        border-radius: 50%;
        background: rgba(255,255,255,.07);
        right: 150px;
        top: -180px;
    }

    .hero::after {
        content: "";
        position: absolute;
        width: 250px;
        height: 250px;
        border-radius: 50%;
        background: rgba(255,255,255,.05);
        right: -80px;
        bottom: -120px;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 620px;
    }

    .badge-store {
        display: inline-block;
        background: rgba(255,255,255,.12);
        border: 1px solid rgba(255,255,255,.18);
        padding: 8px 15px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 18px;
    }

    .hero h1 {
        font-size: 42px;
        line-height: 1.1;
        font-weight: 800;
        margin-bottom: 15px;
    }

    .hero h1 span {
        color: #5cc8ff;
    }

    .hero p {
        font-size: 16px;
        line-height: 1.7;
        color: rgba(255,255,255,.82);
        margin-bottom: 25px;
    }

    .hero-btn {
        display: inline-block;
        background: white;
        color: #092c4c;
        padding: 12px 22px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 700;
        transition: .2s;
    }

    .hero-btn:hover {
        transform: translateY(-2px);
        color: #092c4c;
        box-shadow: 0 8px 20px rgba(0,0,0,.18);
    }

    .hero-device {
        position: relative;
        z-index: 2;
        width: 280px;
        height: 280px;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 40px;
    }

    .hero-device span {
        font-size: 115px;
    }

    /* INFO */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin: 25px 0 35px;
    }

    .info-card {
        background: white;
        border-radius: 17px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        border: 1px solid #edf0f5;
    }

    .info-icon {
        width: 48px;
        height: 48px;
        border-radius: 13px;
        background: #eaf5ff;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0b6cae;
        font-size: 22px;
    }

    .info-card h6 {
        margin: 0 0 4px;
        font-weight: 800;
    }

    .info-card p {
        margin: 0;
        color: #7b8490;
        font-size: 13px;
    }

    /* PRODUCT HEADER */
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: end;
        margin-bottom: 20px;
    }

    .section-header h2 {
        font-size: 25px;
        font-weight: 800;
        margin: 0;
        color: #102f50;
    }

    .section-header p {
        margin: 5px 0 0;
        color: #7b8490;
    }

    .product-count {
        color: #7b8490;
        font-size: 14px;
    }

    /* PRODUCTS */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 22px;
    }

    .product-card {
        background: white;
        border-radius: 18px;
        overflow: hidden;
        border: 1px solid #edf0f5;
        transition: .25s ease;
        height: 100%;
    }

    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 35px rgba(20,50,80,.12);
        border-color: #dce8f2;
    }

    .product-image {
        height: 220px;
        background: #f1f5f9;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 18px;
        transition: .3s;
    }

    .product-card:hover .product-image img {
        transform: scale(1.06);
    }

    .no-image {
        font-size: 50px;
        color: #b6c0cb;
    }

    .stock-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: #e9f9ef;
        color: #168447;
        font-size: 11px;
        font-weight: 700;
        padding: 6px 10px;
        border-radius: 20px;
    }

    .product-info {
        padding: 18px;
    }

    .brand {
        color: #0b78bd;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-bottom: 6px;
    }

    .product-name {
        color: #172b3f;
        font-size: 16px;
        font-weight: 800;
        margin-bottom: 5px;
        min-height: 42px;
    }

    .product-code {
        color: #929aa4;
        font-size: 12px;
        margin-bottom: 14px;
    }

    .price {
        color: #0b5f97;
        font-size: 19px;
        font-weight: 900;
        margin-bottom: 15px;
    }

    .product-actions {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 8px;
    }

    .btn-detail {
        text-align: center;
        text-decoration: none;
        padding: 10px;
        border-radius: 9px;
        border: 1px solid #dce4ec;
        color: #31516b;
        font-size: 13px;
        font-weight: 700;
        transition: .2s;
    }

    .btn-detail:hover {
        background: #f4f7fa;
        color: #173c59;
    }

    .btn-cart {
        border: none;
        background: #092f50;
        color: white;
        border-radius: 9px;
        font-weight: 700;
        font-size: 13px;
        transition: .2s;
    }

    .btn-cart:hover {
        background: #0d4b79;
        transform: translateY(-1px);
    }

    .btn-cart:disabled {
        background: #c9ced4;
        cursor: not-allowed;
    }

    /* ALERT */
    .alert {
        border: none;
        border-radius: 12px;
        margin-bottom: 20px;
    }

    /* RESPONSIVE */
    @media (max-width: 1100px) {
        .products-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .hero-device {
            margin-right: 10px;
        }
    }

    @media (max-width: 850px) {
        .hero {
            padding: 30px;
        }

        .hero-device {
            display: none;
        }

        .products-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .info-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 550px) {
        .store-wrapper {
            padding: 15px;
        }

        .hero {
            padding: 25px;
        }

        .hero h1 {
            font-size: 30px;
        }

        .products-grid {
            grid-template-columns: 1fr;
        }

        .section-header {
            display: block;
        }

        .product-count {
            display: block;
            margin-top: 8px;
        }
    }
</style>


<div class="store-wrapper">

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    {{-- HERO --}}
    <section class="hero">

        <div class="hero-content">

            <div class="badge-store">
                ✦ GATE GADGET STORE
            </div>

            <h1>
                Upgrade Your <span>Digital Life.</span>
            </h1>

            <p>
                Temukan smartphone dan gadget pilihan dengan kualitas terbaik,
                harga bersahabat, dan siap menemani aktivitas digital kamu.
            </p>

            <a href="#produk" class="hero-btn">
                Lihat Produk →
            </a>

        </div>

        <div class="hero-device">
            <span>📱</span>
        </div>

    </section>


    {{-- INFO --}}
    <div class="info-grid">

        <div class="info-card">

            <div class="info-icon">
                🚚
            </div>

            <div>
                <h6>Pengiriman Cepat</h6>
                <p>Pesanan diproses dengan cepat</p>
            </div>

        </div>


        <div class="info-card">

            <div class="info-icon">
                🛡️
            </div>

            <div>
                <h6>Produk Berkualitas</h6>
                <p>Produk pilihan dan terpercaya</p>
            </div>

        </div>


        <div class="info-card">

            <div class="info-icon">
                💳
            </div>

            <div>
                <h6>Belanja Mudah</h6>
                <p>Checkout praktis dan aman</p>
            </div>

        </div>

    </div>


    {{-- PRODUCT HEADER --}}
    <div class="section-header" id="produk">

        <div>
            <h2>Produk Pilihan</h2>

            <p>
                Temukan gadget yang cocok untuk kebutuhanmu.
            </p>
        </div>

        <div class="product-count">
            {{ $products->count() }} produk tersedia
        </div>

    </div>


    {{-- PRODUCT GRID --}}
    <div class="products-grid">

        @forelse($products as $product)

            <div class="product-card">

                {{-- IMAGE --}}
                <div class="product-image">

                    @if($product->image)

                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                        >

                    @else

                        <div class="no-image">
                            📱
                        </div>

                    @endif


                    @if($product->stock > 0)

                        <div class="stock-badge">
                            Stok {{ $product->stock }}
                        </div>

                    @else

                        <div
                            class="stock-badge"
                            style="background:#fff0f0;color:#c62828;"
                        >
                            Habis
                        </div>

                    @endif

                </div>


                {{-- INFO --}}
                <div class="product-info">

                    <div class="brand">
                        {{ $product->brand ?? 'Gadget' }}
                    </div>

                    <div class="product-name">
                        {{ $product->name }}
                    </div>

                    <div class="product-code">
                        Kode: {{ $product->product_code }}
                    </div>

                    <div class="price">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>


                    {{-- ACTION --}}
                    <div class="product-actions">

                        <a
                            href="{{ route('customer.products.show', $product) }}"
                            class="btn-detail"
                        >
                            Detail
                        </a>


                        @if($product->stock > 0)

                            <form
                                action="{{ route('customer.cart.add', $product) }}"
                                method="POST"
                            >

                                @csrf

                                <input
                                    type="hidden"
                                    name="quantity"
                                    value="1"
                                >

                                <button
                                    type="submit"
                                    class="btn-cart w-100 py-2"
                                >
                                    + Keranjang
                                </button>

                            </form>

                        @else

                            <button
                                class="btn-cart w-100 py-2"
                                disabled
                            >
                                Stok Habis
                            </button>

                        @endif

                    </div>

                </div>

            </div>

        @empty

            <div
                style="
                    grid-column: 1 / -1;
                    background:white;
                    border-radius:18px;
                    padding:60px;
                    text-align:center;
                "
            >
                <div style="font-size:50px;">
                    📦
                </div>

                <h4 class="mt-3">
                    Belum ada produk
                </h4>

                <p class="text-muted">
                    Produk akan muncul di sini setelah ditambahkan admin.
                </p>

            </div>

        @endforelse

    </div>

</div>

@endsection