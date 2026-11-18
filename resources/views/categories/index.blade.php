
@extends('layouts.app')

@section('title','Data Kategori')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Kategori</h3>

    <a href="{{ route('categories.create') }}" class="btn btn-primary">
        Tambah Kategori
    </a>
</div>

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

<table class="table table-bordered">

    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Kategori</th>
            <th>Deskripsi</th>
            <th>Jumlah Produk</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

        @forelse($categories as $category)

            <tr>
                <td>{{ $category->id }}</td>

                <td>{{ $category->name }}</td>

                <td>{{ $category->description ?? '-' }}</td>

                <td>{{ $category->products_count }}</td>

                <td>
                    @if($category->status == 'aktif')
                        <span class="badge bg-success">
                            Aktif
                        </span>
                    @else
                        <span class="badge bg-danger">
                            Tidak Aktif
                        </span>
                    @endif
                </td>

                <td>
                    <a
                        href="{{ route('categories.edit', $category) }}"
                        class="btn btn-warning btn-sm"
                    >
                        Edit
                    </a>

                    <form
                        action="{{ route('categories.destroy', $category) }}"
                        method="POST"
                        style="display:inline;"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin ingin menghapus kategori ini?')"
                        >
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>

        @empty

            <tr>
                <td colspan="6" class="text-center">
                    Belum ada kategori.
                </td>
            </tr>

        @endforelse

    </tbody>

</table>

{{ $categories->links() }}

@endsection