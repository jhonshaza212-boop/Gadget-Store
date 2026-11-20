@extends('layouts.app')

@section('content')

<style>
    .customer-detail-page {
        background: #f5f7fb;
        min-height: calc(100vh - 70px);
        padding: 35px;
    }

    .customer-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .back-button {
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 18px;
        background: #062849;
        color: white;
        text-decoration: none;
        border-radius: 8px;
    }

    .back-button:hover {
        background: #164b78;
        color: white;
    }

    .detail-card {
        background: white;
        border-radius: 18px;
        padding: 30px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .08);
    }

    .detail-title {
        color: #102f50;
        font-size: 32px;
        margin-bottom: 25px;
    }

    .detail-row {
        display: grid;
        grid-template-columns: 180px 1fr;
        gap: 10px;
        padding: 12px 0;
        border-bottom: 1px solid #eee;
    }

    .detail-label {
        font-weight: bold;
        color: #555;
    }

    .detail-value {
        color: #333;
    }

    .description {
        margin-top: 25px;
    }

    .description-title {
        font-size: 20px;
        font-weight: bold;
        color: #102f50;
        margin-bottom: 10px;
    }

    .description-text {
        color: #555;
        line-height: 1.7;
    }

    @media (max-width: 600px) {
        .customer-detail-page {
            padding: 20px;
        }

        .detail-row {
            grid-template-columns: 1fr;
            gap: 5px;
        }
    }
</style>

<div class="customer-detail-page">

    <div class="customer-container">

        <a href="{{ route('customer.home') }}" class="back-button">
            ← Kembali ke Produk
        </a>

        <div class="detail-card">

            <h1 class="detail-title">
                {{ $product->name }}
            </h1>

            @if(isset($product->product_code))
                <div class="detail-row">
                    <div class="detail-label">
                        Kode Produk
                    </div>

                    <div class="detail-value">
                        {{ $product->product_code }}
                    </div>
                </div>
            @endif

            @if(isset($product->category))
                <div class="detail-row">
                    <div class="detail-label">
                        Kategori
                    </div>

                    <div class="detail-value">
                        {{ $product->category->name ?? '-' }}
                    </div>
                </div>
            @endif

            @if(isset($product->price))
                <div class="detail-row">
                    <div class="detail-label">
                        Harga
                    </div>

                    <div class="detail-value">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>
                </div>
            @endif

            @if(isset($product->stock))
                <div class="detail-row">
                    <div class="detail-label">
                        Stok
                    </div>

                    <div class="detail-value">
                        {{ $product->stock }}
                    </div>
                </div>
            @endif

            @if(!empty($product->description))
                <div class="description">

                    <div class="description-title">
                        Deskripsi Produk
                    </div>

                    <div class="description-text">
                        {{ $product->description }}
                    </div>

                </div>
            @endif

        </div>

    </div>

</div>

@endsection