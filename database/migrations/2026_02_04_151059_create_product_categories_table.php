<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            
            // --- KITA TAMBAHKAN KOLOMNYA DI SINI ---
            $table->string('name_id');             // Nama Kategori (Indo)
            $table->string('name_en')->nullable(); // Nama Kategori (Inggris)
            $table->string('slug')->unique();      // Slug URL
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_categories');
    }
};