@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-heading', 'Dashboard Gadget Store')

@section('content')

<div class="mb-4">
    <p class="text-secondary">
        Ringkasan inventaris dan kondisi stok produk toko gadget.
    </p>
</div>


{{-- ====================================================== --}}
{{-- STATISTIK UTAMA --}}
{{-- ====================================================== --}}

<div class="row g-3 mb-4">

    {{-- TOTAL PRODUK --}}
    <div class="col-sm-6 col-xl-3">

        <div class="card stat-card shadow-sm">

            <div class="card-body">

                <div class="text-secondary">
                    Total Produk
                </div>

                <div class="d-flex justify-content-between align-items-center">

                    <h2 class="fw-bold mb-0">
                        {{ number_format($totalProducts) }}
                    </h2>

                    <i class="bi bi-phone fs-2 text-primary"></i>

                </div>

            </div>

        </div>

    </div>


    {{-- KATEGORI --}}
    <div class="col-sm-6 col-xl-3">

        <div class="card stat-card shadow-sm">

            <div class="card-body">

                <div class="text-secondary">
                    Kategori
                </div>

                <div class="d-flex justify-content-between align-items-center">

                    <h2 class="fw-bold mb-0">
                        {{ number_format($totalCategories) }}
                    </h2>

                    <i class="bi bi-tags fs-2 text-success"></i>

                </div>

            </div>

        </div>

    </div>


    {{-- TOTAL UNIT STOK --}}
    <div class="col-sm-6 col-xl-3">

        <div class="card stat-card shadow-sm">

            <div class="card-body">

                <div class="text-secondary">
                    Total Unit Stok
                </div>

                <div class="d-flex justify-content-between align-items-center">

                    <h2 class="fw-bold mb-0">
                        {{ number_format($totalStock) }}
                    </h2>

                    <i class="bi bi-box-seam fs-2 text-info"></i>

                </div>

            </div>

        </div>

    </div>


    {{-- STOK MENIPIS --}}
    <div class="col-sm-6 col-xl-3">

        <div class="card stat-card shadow-sm">

            <div class="card-body">

                <div class="text-secondary">
                    Stok Menipis (≤ 5)
                </div>

                <div class="d-flex justify-content-between align-items-center">

                    <h2 class="fw-bold mb-0">
                        {{ number_format($lowStockProducts) }}
                    </h2>

                    <i class="bi bi-exclamation-triangle fs-2 text-danger"></i>

                </div>

            </div>

        </div>

    </div>

</div>



{{-- ====================================================== --}}
{{-- GRAFIK PRODUK + GRAFIK LINGKARAN --}}
{{-- ====================================================== --}}

<div class="row g-3 mb-4">

    {{-- JUMLAH PRODUK PER KATEGORI --}}
    <div class="col-lg-8">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <h5 class="fw-bold">
                    Kondisi Stok per Kategori
                </h5>

                <p class="text-secondary small">
                    Jumlah produk dengan stok menipis, cukup, dan banyak.
                </p>

                <div style="height:320px">

                    <canvas id="categoryChart"></canvas>

                </div>

            </div>

        </div>

    </div>


    {{-- KOMPOSISI STOK --}}
    <div class="col-lg-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <h5 class="fw-bold">
                    Komposisi Kondisi Stok
                </h5>

                <p class="text-secondary small">
                    Kondisi stok berdasarkan jumlah produk.
                </p>

                <div style="height:280px">

                    <canvas id="stockChart"></canvas>

                </div>

                <div class="small text-secondary mt-2">

                    Menipis: 0–5 unit •
                    Cukup: 6–20 unit •
                    Banyak: lebih dari 20 unit

                </div>

            </div>

        </div>

    </div>

</div>



{{-- ====================================================== --}}
{{-- TOTAL UNIT STOK PER KATEGORI --}}
{{-- ====================================================== --}}

<div class="row g-3 mb-4">

    <div class="col-lg-12">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h5 class="fw-bold">
                    Total Unit Stok per Kategori
                </h5>

                <p class="text-secondary small">
                    Jumlah seluruh unit stok berdasarkan kategori.
                </p>

                <div style="height:360px">

                    <canvas id="stockByCategoryChart"></canvas>

                </div>

            </div>

        </div>

    </div>

</div>



{{-- ====================================================== --}}
{{-- PRODUK TERBARU --}}
{{-- ====================================================== --}}

<div class="card border-0 shadow-sm">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h5 class="fw-bold mb-0">
                Produk Terbaru
            </h5>

            <a href="{{ route('products.index') }}"
               class="btn btn-sm btn-outline-primary">

                Lihat semua

            </a>

        </div>


        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>

                    </tr>

                </thead>


                <tbody>

                    @if($latestProducts->count() > 0)

                        @foreach($latestProducts as $product)

                            <tr>

                                <td>
                                    {{ $product->product_code }}
                                </td>

                                <td class="fw-semibold">
                                    {{ $product->name }}
                                </td>

                                <td>
                                    {{ $product->category->name }}
                                </td>

                                <td>
                                    Rp {{ number_format((float) $product->price, 0, ',', '.') }}
                                </td>

                                <td>
                                    {{ $product->stock }}
                                </td>

                            </tr>

                        @endforeach

                    @else

                        <tr>

                            <td colspan="5"
                                class="text-center text-secondary">

                                Belum ada data produk.
                                Tambahkan produk untuk menampilkan analitik.

                            </td>

                        </tr>

                    @endif

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection



@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>


// ======================================================
// DATA DARI DATABASE
// ======================================================

const categoryLabels = @json(
    $categoryStats
        ->pluck('name')
        ->values()
);


const lowStockCounts = @json(
    $categoryStats
        ->pluck('low_stock_count')
        ->map(fn($value) => (int) $value)
        ->values()
);


const sufficientStockCounts = @json(
    $categoryStats
        ->pluck('sufficient_stock_count')
        ->map(fn($value) => (int) $value)
        ->values()
);


const highStockCounts = @json(
    $categoryStats
        ->pluck('high_stock_count')
        ->map(fn($value) => (int) $value)
        ->values()
);


const stockTotals = @json(
    $categoryStats
        ->pluck('stock_total')
        ->map(fn($value) => (int) $value)
        ->values()
);


const stockStatus = @json($stockStatus);



// ======================================================
// WARNA KONDISI STOK
// HARUS SAMA UNTUK SEMUA DIAGRAM
// ======================================================

const stockColors = {
    low: '#e74a3b',
    sufficient: '#1cc88a',
    high: '#f6c23e'
};



// ======================================================
// GRAFIK 1
// KONDISI STOK PER KATEGORI
// ======================================================

new Chart(
    document.getElementById('categoryChart'),
    {

        type: 'bar',

        data: {

            labels: categoryLabels,

            datasets: [

                {

                    label: 'Stok Menipis (0–5)',

                    data: lowStockCounts,

                    backgroundColor: stockColors.low,

                    borderWidth: 1

                },

                {

                    label: 'Stok Cukup (6–20)',

                    data: sufficientStockCounts,

                    backgroundColor: stockColors.sufficient,

                    borderWidth: 1

                },

                {

                    label: 'Stok Banyak (>20)',

                    data: highStockCounts,

                    backgroundColor: stockColors.high,

                    borderWidth: 1

                }

            ]

        },


        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {

                    display: true

                },

                tooltip: {

                    callbacks: {

                        label: function(context) {

                            return context.dataset.label + ': ' +
                                Number(context.raw)
                                    .toLocaleString('id-ID') +
                                ' produk';

                        }

                    }

                }

            },


            scales: {

                y: {

                    beginAtZero: true,

                    ticks: {

                        precision: 0,

                        callback: function(value) {

                            return Number(value)
                                .toLocaleString('id-ID');

                        }

                    }

                }

            }

        }

    }
);



// ======================================================
// GRAFIK LINGKARAN
// KOMPOSISI KONDISI STOK
// ======================================================

new Chart(
    document.getElementById('stockChart'),
    {

        type: 'pie',

        data: {

            labels: [

                'Stok Menipis',
                'Stok Cukup',
                'Stok Banyak'

            ],

            datasets: [

                {

                    data: stockStatus,

                    // WARNA SAMA DENGAN DIAGRAM BATANG
                    backgroundColor: [

                        stockColors.low,
                        stockColors.sufficient,
                        stockColors.high

                    ],

                    borderColor: '#ffffff',

                    borderWidth: 2

                }

            ]

        },


        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {

                    position: 'bottom'

                },

                tooltip: {

                    callbacks: {

                        label: function(context) {

                            return ' ' +
                                context.label +
                                ': ' +
                                Number(context.raw)
                                    .toLocaleString('id-ID') +
                                ' produk';

                        }

                    }

                }

            }

        }

    }
);



// ======================================================
// GRAFIK 2
// TOTAL UNIT STOK PER KATEGORI
// ======================================================

new Chart(
    document.getElementById('stockByCategoryChart'),
    {

        type: 'bar',

        data: {

            labels: categoryLabels,

            datasets: [

                {

                    label: 'Total Unit Stok',

                    data: stockTotals,

                    backgroundColor: '#4e73df',

                    borderWidth: 1

                }

            ]

        },


        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {

                    display: true

                },

                tooltip: {

                    callbacks: {

                        label: function(context) {

                            return ' Total stok: ' +
                                Number(context.raw)
                                    .toLocaleString('id-ID') +
                                ' unit';

                        }

                    }

                }

            },


            scales: {

                y: {

                    // PENTING:
                    // Mulai dari 0 supaya tinggi batang
                    // benar-benar sesuai dengan nilai aslinya.

                    beginAtZero: true,

                    ticks: {

                        precision: 0,

                        callback: function(value) {

                            return Number(value)
                                .toLocaleString('id-ID');

                        }

                    }

                }

            }

        }

    }
);

</script>

@endpush