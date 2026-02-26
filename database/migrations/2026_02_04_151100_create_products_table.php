<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
Schema::create('products', function (Blueprint $table) {
    $table->id();
    
    // Ini untuk 'jenis' (Relasi ke kategori)
    $table->foreignId('category_id')
          ->nullable()
          ->constrained('product_categories')
          ->nullOnDelete();

    $table->string('name'); // Nama obat
    $table->string('slug')->unique(); // Tetap wajib untuk URL Laravel
    $table->string('manufacturer')->nullable(); // Pabrikan
    $table->string('image_path')->nullable(); // Tetap simpan ini untuk foto obat
    
    // Kolom price, stock, description, dll DIHAPUS dari sini
    
    $table->boolean('is_active')->default(true);
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};