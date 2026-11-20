@extends('layouts.app')

@section('content')

<h3>Data Produk</h3>

<a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
    Tambah Produk
</a>

<form method="GET" class="row g-2 my-3">

    <input
        name="q"
        value="{{ request('q') }}"
        class="form-control"
        placeholder="Cari kode, nama, merek"
    >

    <select name="category_id" class="form-select">
        <option value="">Semua kategori</option>

        @foreach($categories as $category)
            <option
                value="{{ $category->id }}"
                @selected(request('category_id') == $category->id)
            >
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <button class="btn btn-outline-primary btn-sm">
        Cari / Filter
    </button>

</form>

<table class="table">

    <thead>
        <tr>
            <th>Gambar</th>
            <th>Kode</th>
            <th>Produk</th>
            <th>Kategori</th>
            <th>Merek</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

        @forelse($products as $product)

            <tr>
                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="rounded" style="width: 48px; height: 48px; object-fit: cover;">
                    @else
                        <div class="bg-light text-secondary rounded d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; font-size: 11px;">
                            No Img
                        </div>
                    @endif
                </td>

                <td>{{ $product->product_code }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->brand }}</td>
                <td>Rp {{ number_format((float) $product->price, 0, ',', '.') }}</td>
                <td>{{ $product->stock }}</td>

                <td class="text-nowrap">
                    <a
                        href="{{ route('products.edit', $product) }}"
                        class="btn btn-warning btn-sm"
                    >
                        Edit
                    </a>

                    <form
                        method="POST"
                        action="{{ route('products.destroy', $product) }}"
                        class="d-inline"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin ingin menghapus produk ini?')"
                        >
                            Hapus
                        </button>
                    </form>

                </td>
            </tr>

        @empty

            <tr>
                <td colspan="8">
                    Belum ada produk.
                </td>
            </tr>

        @endforelse

    </tbody>

</table>

{{ $products->links() }}

@endsection

<style>
    .pagination {
        margin-top: 15px;
    }

    .pagination .page-link {
        padding: 4px 8px !important;
        font-size: 12px !important;
        min-width: auto !important;
    }

    .pagination .page-item {
        margin: 0 2px;
    }
</style>