@extends('layouts.app')

@section('content')

<style>
    body {
        background: #f4f6f9;
    }

    .admin-wrapper {
        padding: 30px;
        max-width: 1500px;
        margin: auto;
    }

    /* HEADER */
    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
    }

    .admin-header h1 {
        font-size: 28px;
        font-weight: 800;
        color: #14283d;
        margin: 0;
    }

    .admin-header p {
        color: #7b8794;
        margin: 5px 0 0;
    }

    .admin-date {
        background: white;
        border: 1px solid #e7ebef;
        border-radius: 10px;
        padding: 10px 16px;
        color: #607080;
        font-size: 13px;
    }

    /* WELCOME */
    .welcome-card {
        background: linear-gradient(120deg, #071d35, #0b4775);
        border-radius: 20px;
        padding: 30px;
        color: white;
        position: relative;
        overflow: hidden;
        margin-bottom: 25px;
    }

    .welcome-card::after {
        content: "";
        position: absolute;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background: rgba(255,255,255,.06);
        right: -80px;
        top: -140px;
    }

    .welcome-card h2 {
        font-weight: 800;
        margin-bottom: 8px;
        position: relative;
        z-index: 2;
    }

    .welcome-card p {
        color: rgba(255,255,255,.75);
        margin: 0;
        position: relative;
        z-index: 2;
    }

    .admin-label {
        display: inline-block;
        background: rgba(255,255,255,.12);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 12px;
        position: relative;
        z-index: 2;
    }

    /* STAT */
    .stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 25px;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 22px;
        border: 1px solid #e9edf2;
        display: flex;
        align-items: center;
        gap: 16px;
        transition: .2s;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(20,40,60,.08);
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        background: #eaf4fb;
    }

    .stat-info small {
        color: #8a96a3;
        display: block;
        margin-bottom: 3px;
    }

    .stat-info strong {
        font-size: 25px;
        color: #172b3e;
    }

    /* CONTENT GRID */
    .content-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 20px;
    }

    .panel {
        background: white;
        border-radius: 17px;
        border: 1px solid #e8edf1;
        overflow: hidden;
    }

    .panel-header {
        padding: 20px 22px;
        border-bottom: 1px solid #edf0f3;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .panel-header h3 {
        margin: 0;
        font-size: 17px;
        font-weight: 800;
        color: #172b3e;
    }

    .panel-header a {
        color: #0a6ba8;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
    }

    .panel-body {
        padding: 20px;
    }

    /* QUICK ACTION */
    .quick-actions {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }

    .quick-btn {
        text-decoration: none;
        border: 1px solid #e6ebef;
        border-radius: 12px;
        padding: 17px;
        color: #20384e;
        transition: .2s;
        background: #fbfcfd;
    }

    .quick-btn:hover {
        background: #f1f7fb;
        border-color: #cddfea;
        transform: translateY(-2px);
        color: #0b5d8f;
    }

    .quick-btn .icon {
        font-size: 24px;
        margin-bottom: 8px;
    }

    .quick-btn strong {
        display: block;
        font-size: 13px;
    }

    .quick-btn span {
        display: block;
        color: #8a96a3;
        font-size: 11px;
        margin-top: 3px;
    }

    /* PRODUCT */
    .product-row {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 13px 0;
        border-bottom: 1px solid #f0f2f4;
    }

    .product-row:last-child {
        border-bottom: none;
    }

    .product-img {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        background: #f1f4f7;
        object-fit: contain;
        padding: 4px;
    }

    .product-img-empty {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        background: #eef2f5;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-name {
        font-weight: 700;
        font-size: 13px;
        color: #24384b;
    }

    .product-code {
        color: #8b96a1;
        font-size: 11px;
    }

    .product-price {
        margin-left: auto;
        font-size: 13px;
        font-weight: 800;
        color: #0a659e;
    }

    /* EMPTY */
    .empty {
        text-align: center;
        padding: 35px 10px;
        color: #8995a0;
    }

    .empty-icon {
        font-size: 38px;
        margin-bottom: 8px;
    }

    /* RESPONSIVE */
    @media(max-width: 1000px) {
        .stats {
            grid-template-columns: repeat(2, 1fr);
        }

        .content-grid {
            grid-template-columns: 1fr;
        }
    }

    @media(max-width: 600px) {
        .admin-wrapper {
            padding: 15px;
        }

        .admin-header {
            display: block;
        }

        .admin-date {
            display: inline-block;
            margin-top: 12px;
        }

        .stats {
            grid-template-columns: 1fr;
        }

        .quick-actions {
            grid-template-columns: 1fr;
        }
    }
</style>


<div class="admin-wrapper">

    {{-- HEADER --}}
    <div class="admin-header">

        <div>
            <h1>Dashboard Admin</h1>

            <p>
                Kelola GATE GADGET STORE dari satu tempat.
            </p>
        </div>

        <div class="admin-date">
            📅 {{ now()->format('d F Y') }}
        </div>

    </div>


    {{-- WELCOME --}}
    <div class="welcome-card">

        <span class="admin-label">
            ADMIN PANEL
        </span>

        <h2>
            Selamat datang, {{ auth()->user()->name }} 👋
        </h2>

        <p>
            Pantau produk, kategori, dan pesanan toko dengan mudah.
        </p>

    </div>


    {{-- STATISTIK --}}
    <div class="stats">

        {{-- PRODUK --}}
        <div class="stat-card">

            <div class="stat-icon">
                📦
            </div>

            <div class="stat-info">

                <small>Total Produk</small>

                <strong>
                    {{ \App\Models\Product::count() }}
                </strong>

            </div>

        </div>


        {{-- KATEGORI --}}
        <div class="stat-card">

            <div class="stat-icon">
                🗂️
            </div>

            <div class="stat-info">

                <small>Total Kategori</small>

                <strong>
                    {{ \App\Models\Category::count() }}
                </strong>

            </div>

        </div>


        {{-- PESANAN --}}
        <div class="stat-card">

            <div class="stat-icon">
                🛒
            </div>

            <div class="stat-info">

                <small>Total Pesanan</small>

                <strong>
                    {{ \App\Models\Order::count() }}
                </strong>

            </div>

        </div>


        {{-- PENDING --}}
        <div class="stat-card">

            <div class="stat-icon">
                ⏳
            </div>

            <div class="stat-info">

                <small>Pesanan Pending</small>

                <strong>
                    {{ \App\Models\Order::where('status', 'pending')->count() }}
                </strong>

            </div>

        </div>

    </div>


    {{-- CONTENT --}}
    <div class="content-grid">


        {{-- PRODUK TERBARU --}}
        <div class="panel">

            <div class="panel-header">

                <h3>
                    Produk Terbaru
                </h3>

                <a href="{{ route('products.index') }}">
                    Lihat Semua →
                </a>

            </div>


            <div class="panel-body">

                @php
                    $products = \App\Models\Product::latest()->take(5)->get();
                @endphp

                @forelse($products as $product)

                    <div class="product-row">

                        @if($product->image)

                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                class="product-img"
                            >

                        @else

                            <div class="product-img-empty">
                                📱
                            </div>

                        @endif


                        <div>

                            <div class="product-name">
                                {{ $product->name }}
                            </div>

                            <div class="product-code">
                                {{ $product->product_code }}
                                · Stok {{ $product->stock }}
                            </div>

                        </div>


                        <div class="product-price">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>

                    </div>

                @empty

                    <div class="empty">

                        <div class="empty-icon">
                            📦
                        </div>

                        Belum ada produk.

                    </div>

                @endforelse

            </div>

        </div>


        {{-- AKSI CEPAT --}}
        <div class="panel">

            <div class="panel-header">

                <h3>
                    Aksi Cepat
                </h3>

            </div>


            <div class="panel-body">

                <div class="quick-actions">

                    <a
                        href="{{ route('products.create') }}"
                        class="quick-btn"
                    >
                        <div class="icon">
                            ➕
                        </div>

                        <strong>
                            Tambah Produk
                        </strong>

                        <span>
                            Masukkan produk baru
                        </span>

                    </a>


                    <a
                        href="{{ route('categories.create') }}"
                        class="quick-btn"
                    >
                        <div class="icon">
                            🗂️
                        </div>

                        <strong>
                            Tambah Kategori
                        </strong>

                        <span>
                            Buat kategori produk
                        </span>

                    </a>


                    <a
                        href="{{ route('products.index') }}"
                        class="quick-btn"
                    >
                        <div class="icon">
                            📦
                        </div>

                        <strong>
                            Kelola Produk
                        </strong>

                        <span>
                            Edit dan hapus produk
                        </span>

                    </a>


                    <a
                        href="{{ route('admin.orders') }}"
                        class="quick-btn"
                    >
                        <div class="icon">
                            🛒
                        </div>

                        <strong>
                            Kelola Pesanan
                        </strong>

                        <span>
                            Cek pesanan pelanggan
                        </span>

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection