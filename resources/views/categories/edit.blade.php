@extends('layouts.app')

@section('content')

<div style="max-width: 700px; margin: 30px auto;">

    <div style="
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    ">

        <h2 style="margin-bottom: 25px;">
            Edit Kategori
        </h2>

        @if ($errors->any())
            <div style="
                background: #fee2e2;
                color: #991b1b;
                padding: 15px;
                border-radius: 8px;
                margin-bottom: 20px;
            ">
                <ul style="margin: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.update', $category->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div style="margin-bottom: 20px;">
                <label style="display:block; margin-bottom:8px;">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $category->name) }}"
                    required
                    style="
                        width:100%;
                        padding:12px;
                        border:1px solid #ddd;
                        border-radius:8px;
                        box-sizing:border-box;
                    "
                >
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display:block; margin-bottom:8px;">
                    Deskripsi
                </label>

                <textarea
                    name="descripte"
                    rows="4"
                    style="
                        width:100%;
                        padding:12px;
                        border:1px solid #ddd;
                        border-radius:8px;
                        box-sizing:border-box;
                    "
                >{{ old('descripte', $category->descripte) }}</textarea>
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display:block; margin-bottom:8px;">
                    Status
                </label>

                <select
                    name="status"
                    required
                    style="
                        width:100%;
                        padding:12px;
                        border:1px solid #ddd;
                        border-radius:8px;
                        box-sizing:border-box;
                    "
                >
                    <option value="aktif"
                        {{ old('status', $category->status) == 'aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="tidak aktif"
                        {{ old('status', $category->status) == 'tidak aktif' ? 'selected' : '' }}>
                        Tidak Aktif
                    </option>
                </select>
            </div>

            <div style="display:flex; gap:10px;">

                <button
                    type="submit"
                    style="
                        background:#062849;
                        color:white;
                        border:none;
                        padding:12px 20px;
                        border-radius:8px;
                        cursor:pointer;
                    "
                >
                    Update Kategori
                </button>

                <a
                    href="{{ route('categories.index') }}"
                    style="
                        background:#e5e7eb;
                        color:#111827;
                        padding:12px 20px;
                        border-radius:8px;
                        text-decoration:none;
                    "
                >
                    Batal
                </a>

            </div>

        </form>

    </div>

</div>

@endsection