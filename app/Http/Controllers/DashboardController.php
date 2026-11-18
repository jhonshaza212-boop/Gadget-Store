<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total produk
        $totalProducts = Product::count();

        // Total kategori
        $totalCategories = Category::count();

        // Total seluruh unit stok
        $totalStock = Product::sum('stock');

        // Jumlah produk dengan stok <= 5
        $lowStockProducts = Product::where('stock', '<=', 5)->count();

        // Estimasi nilai seluruh persediaan
        $inventoryValue = Product::selectRaw(
            'COALESCE(SUM(price * stock), 0) as total'
        )->value('total');


        // ==========================================
        // DATA PRODUK PER KATEGORI
        // ==========================================

        $categoryStats = Category::query()
            ->leftJoin(
                'products',
                'categories.id',
                '=',
                'products.category_id'
            )
            ->select(
                'categories.name',
                DB::raw('COALESCE(SUM(products.stock), 0) as stock_total'),
                DB::raw('SUM(CASE WHEN products.stock <= 5 THEN 1 ELSE 0 END) as low_stock_count'),
                DB::raw('SUM(CASE WHEN products.stock BETWEEN 6 AND 20 THEN 1 ELSE 0 END) as sufficient_stock_count'),
                DB::raw('SUM(CASE WHEN products.stock > 20 THEN 1 ELSE 0 END) as high_stock_count')
            )
            ->groupBy(
                'categories.id',
                'categories.name'
            )
            ->orderBy('categories.name')
            ->get();


        // ==========================================
        // KONDISI STOK
        // ==========================================

        $stockStatus = [
            Product::where('stock', '<=', 5)->count(),

            Product::whereBetween('stock', [6, 20])->count(),

            Product::where('stock', '>', 20)->count(),
        ];


        // ==========================================
        // DATA NILAI STOK PRODUK
        // Untuk grafik Harga x Stok
        // ==========================================

        $priceStockStats = Product::select(
            'name',
            'price',
            'stock'
        )
            ->orderBy('id')
            ->take(10)
            ->get();


        // ==========================================
        // PRODUK TERBARU
        // ==========================================

        $latestProducts = Product::with('category')
            ->latest()
            ->take(5)
            ->get();


        // ==========================================
        // KIRIM SEMUA DATA KE DASHBOARD
        // ==========================================

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalStock',
            'lowStockProducts',
            'inventoryValue',
            'categoryStats',
            'stockStatus',
            'priceStockStats',
            'latestProducts'
        ));
    }
}