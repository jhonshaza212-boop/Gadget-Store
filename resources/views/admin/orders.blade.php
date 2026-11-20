@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

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


    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Kelola Pesanan</h2>
            <p class="text-muted mb-0">
                Kelola pesanan pelanggan GATE GADGET STORE
            </p>
        </div>
    </div>


    {{-- CARD --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">
                Daftar Pesanan
            </h5>
        </div>

        <div class="card-body">

            @if($orders->count() > 0)

                @foreach($orders as $order)

                    <div class="border rounded p-4 mb-4">

                        {{-- INFO PESANAN --}}
                        <div class="row mb-3">

                            <div class="col-md-6">
                                <h5 class="fw-bold mb-2">
                                    Pesanan #{{ $order->id }}
                                </h5>

                                <p class="mb-1">
                                    <strong>Pelanggan:</strong>
                                    {{ $order->user->name ?? '-' }}
                                </p>

                                <p class="mb-1">
                                    <strong>Email:</strong>
                                    {{ $order->user->email ?? '-' }}
                                </p>

                                <p class="mb-0 text-muted">
                                    {{ $order->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>


                            <div class="col-md-6 text-md-end">

                                <p class="mb-2">
                                    <strong>Total:</strong>
                                    <span class="text-primary fw-bold">
                                        Rp {{ number_format($order->total, 0, ',', '.') }}
                                    </span>
                                </p>

                                {{-- UPDATE STATUS --}}
                                <form
                                    action="{{ route('admin.orders.status', $order) }}"
                                    method="POST"
                                    class="d-inline-flex gap-2"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <select
                                        name="status"
                                        class="form-select"
                                        style="width: 180px;"
                                    >
                                        <option value="pending"
                                            {{ $order->status == 'pending' ? 'selected' : '' }}>
                                            Pending
                                        </option>

                                        <option value="diproses"
                                            {{ $order->status == 'diproses' ? 'selected' : '' }}>
                                            Diproses
                                        </option>

                                        <option value="selesai"
                                            {{ $order->status == 'selesai' ? 'selected' : '' }}>
                                            Selesai
                                        </option>

                                        <option value="dibatalkan"
                                            {{ $order->status == 'dibatalkan' ? 'selected' : '' }}>
                                            Dibatalkan
                                        </option>
                                    </select>

                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        Update
                                    </button>
                                </form>

                            </div>

                        </div>


                        {{-- ITEM PESANAN --}}
                        <div class="table-responsive">

                            <table class="table table-bordered align-middle mb-0">

                                <thead class="table-light">
                                    <tr>
                                        <th width="100">Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($order->items as $item)

                                        <tr>

                                            <td>
                                                @if($item->product && $item->product->image)
                                                    <img
                                                        src="{{ asset('storage/' . $item->product->image) }}"
                                                        width="70"
                                                        height="70"
                                                        style="object-fit: cover; border-radius: 8px;"
                                                    >
                                                @else
                                                    <div
                                                        style="
                                                            width:70px;
                                                            height:70px;
                                                            background:#f1f1f1;
                                                            border-radius:8px;
                                                            display:flex;
                                                            align-items:center;
                                                            justify-content:center;
                                                            color:#999;
                                                            font-size:12px;
                                                        "
                                                    >
                                                        No Image
                                                    </div>
                                                @endif
                                            </td>

                                            <td>
                                                <strong>
                                                    {{ $item->product->name ?? 'Produk tidak ditemukan' }}
                                                </strong>

                                                @if($item->product)
                                                    <br>

                                                    <small class="text-muted">
                                                        {{ $item->product->product_code }}
                                                    </small>
                                                @endif
                                            </td>

                                            <td>
                                                Rp {{ number_format($item->price, 0, ',', '.') }}
                                            </td>

                                            <td>
                                                {{ $item->quantity }}
                                            </td>

                                            <td>
                                                <strong>
                                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                                </strong>
                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    </div>

                @endforeach

            @else

                <div class="text-center py-5">
                    <h5 class="text-muted">
                        Belum ada pesanan.
                    </h5>

                    <p class="text-muted mb-0">
                        Pesanan pelanggan akan muncul di halaman ini.
                    </p>
                </div>

            @endif

        </div>

    </div>

</div>

@endsection