@extends('layouts.app')

@section('content')

<style>
    .orders-container {
        max-width: 1100px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .orders-title {
        color: #102f50;
        margin-bottom: 25px;
    }

    .order-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
        margin-bottom: 15px;
    }

    .order-id {
        font-weight: bold;
        color: #102f50;
    }

    .status {
        display: inline-block;
        padding: 7px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: bold;
        text-transform: capitalize;
        background: #fff3cd;
        color: #856404;
    }

    .product-row {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 12px 0;
    }

    .product-image {
        width: 65px;
        height: 65px;
        object-fit: cover;
        border-radius: 8px;
        background: #f1f1f1;
    }

    .product-info {
        flex: 1;
    }

    .product-name {
        font-weight: bold;
        color: #102f50;
    }

    .product-detail {
        color: #666;
        font-size: 14px;
        margin-top: 4px;
    }

    .subtotal {
        font-weight: bold;
        color: #102f50;
    }

    .order-total {
        border-top: 1px solid #ddd;
        margin-top: 15px;
        padding-top: 18px;
        display: flex;
        justify-content: space-between;
        font-size: 18px;
        font-weight: bold;
        color: #102f50;
    }

    .empty-orders {
        background: white;
        border-radius: 15px;
        padding: 50px;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }

    .empty-orders h3 {
        color: #102f50;
    }

    .back-btn {
        display: inline-block;
        margin-top: 20px;
        background: #062849;
        color: white;
        padding: 10px 18px;
        border-radius: 8px;
        text-decoration: none;
    }

    .back-btn:hover {
        color: white;
        background: #0d3d6b;
    }

    @media (max-width: 700px) {
        .order-header {
            display: block;
        }

        .status {
            margin-top: 10px;
        }

        .product-row {
            align-items: flex-start;
        }

        .subtotal {
            font-size: 14px;
        }
    }
</style>

<div class="orders-container">

    <h1 class="orders-title">
        Riwayat Pesanan
    </h1>

    @if(session('success'))
        <div style="
            background: #d1e7dd;
            color: #0f5132;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        ">
            {{ session('success') }}
        </div>
    @endif

    @if($orders->count() > 0)

        @foreach($orders as $order)

            <div class="order-card">

                <div class="order-header">

                    <div>
                        <div class="order-id">
                            Pesanan #{{ $order->id }}
                        </div>

                        <div style="
                            color: #777;
                            font-size: 14px;
                            margin-top: 5px;
                        ">
                            {{ $order->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>

                    <div class="status">
                        {{ $order->status }}
                    </div>

                </div>


                {{-- PRODUK --}}
                @foreach($order->items as $item)

                    <div class="product-row">

                        @if($item->product && $item->product->image)

                            <img
                                src="{{ asset('storage/' . $item->product->image) }}"
                                class="product-image"
                                alt="{{ $item->product->name }}"
                            >

                        @else

                            <div class="product-image"></div>

                        @endif


                        <div class="product-info">

                            <div class="product-name">
                                {{ $item->product->name ?? 'Produk' }}
                            </div>

                            <div class="product-detail">
                                {{ $item->quantity }} ×
                                Rp {{ number_format(
                                    $item->price,
                                    0,
                                    ',',
                                    '.'
                                ) }}
                            </div>

                        </div>


                        <div class="subtotal">
                            Rp {{ number_format(
                                $item->subtotal,
                                0,
                                ',',
                                '.'
                            ) }}
                        </div>

                    </div>

                @endforeach


                {{-- TOTAL --}}
                <div class="order-total">

                    <span>
                        Total Pesanan
                    </span>

                    <span>
                        Rp {{ number_format(
                            $order->total,
                            0,
                            ',',
                            '.'
                        ) }}
                    </span>

                </div>

            </div>

        @endforeach

    @else

        <div class="empty-orders">

            <h3>
                Belum Ada Pesanan
            </h3>

            <p style="color: #666;">
                Kamu belum memiliki riwayat pesanan.
            </p>

            <a
                href="{{ route('customer.home') }}"
                class="back-btn"
            >
                Mulai Belanja
            </a>

        </div>

    @endif

</div>

@endsection