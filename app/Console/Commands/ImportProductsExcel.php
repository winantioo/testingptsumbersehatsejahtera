<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;

class ImportProductsExcel extends Command
{
    protected $signature = 'products:import {path : Path ke file excel (.xlsx)}';
    protected $description = 'Import products from Excel (nama obat + pabrikan)';

    public function handle(): int
    {
        $path = $this->argument('path');

        if (!file_exists($path)) {
            $this->error("File tidak ditemukan: {$path}");
            return self::FAILURE;
        }

        Excel::import(new ProductsImport, $path);

        $this->info('Import selesai ✅');
        return self::SUCCESS;
    }
}
