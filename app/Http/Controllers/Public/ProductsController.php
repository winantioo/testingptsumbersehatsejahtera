<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        // 1. Tangkap parameter dari URL
        $q = trim((string) $request->query('q', ''));
        $categorySlug = $request->query('category');
        $manufacturer = $request->query('manufacturer');

        // 2. Ambil data untuk opsi Dropdown Filter di Blade
        // Mengambil semua kategori
        $categories = ProductCategory::orderBy('name_id')->get();
        
        // Mengambil daftar pabrikan (manufacturer) yang unik dan tidak kosong
        $manufacturers = Product::select('manufacturer')
            ->whereNotNull('manufacturer')
            ->where('manufacturer', '!=', '')
            ->distinct()
            ->orderBy('manufacturer')
            ->pluck('manufacturer');

        // 3. Query Produk beserta Filternya
        $products = Product::query()
            ->with('category:id,slug,name_id,name_en')
            // Filter berdasarkan pencarian nama
            ->when($q !== '', fn($query) => $query->where('name', 'like', "%{$q}%"))
            // Filter berdasarkan kategori (menggunakan whereHas karena relasi)
            ->when($categorySlug, function ($query) use ($categorySlug) {
                $query->whereHas('category', function ($q) use ($categorySlug) {
                    $q->where('slug', $categorySlug);
                });
            })
            // Filter berdasarkan pabrikan
            ->when($manufacturer, function ($query) use ($manufacturer) {
                $query->where('manufacturer', $manufacturer);
            })
            ->orderBy('name')
            ->paginate(20) // Sesuai dengan kode Anda (24 produk per halaman)
            ->withQueryString(); // Memastikan parameter filter tidak hilang saat pindah halaman paginasi

        // 4. Return ke view (Pastikan path view-nya sesuai: pages.products atau products.index)
        return view('pages.products', compact(
            'products', 
            'q', 
            'categories', 
            'manufacturers', 
            'categorySlug', 
            'manufacturer'
        ));
    }
}