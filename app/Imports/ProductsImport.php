<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\ProductCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (!isset($row['nama']) || empty($row['nama'])) {
            return null;
        }

        // MENCARI ATAU MEMBUAT KATEGORI OTOMATIS
        // Jika kolom 'jenis' di Excel kosong, kita beri nama 'Umum'
        $jenisName = !empty($row['jenis']) ? $row['jenis'] : 'Umum';

        $category = ProductCategory::firstOrCreate(
            ['name_id' => $jenisName],
            ['slug' => Str::slug($jenisName)]
        );

        return new Product([
            'name'         => $row['nama'],
            'manufacturer' => $row['pabrikan'] ?? null,
            'category_id'  => $category->id, // Menggunakan ID kategori yang baru dibuat/ditemukan
            'slug'         => Str::slug($row['nama']),
            'image_path'   => null,
        ]);
    }
}