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
        Schema::create('sales_contacts', function (Blueprint $table) {
            $table->id();
            
            // Kolom yang disesuaikan dengan form admin kamu
            $table->string('name');             // Untuk 'Nama Sales'
            $table->string('area_id');          // Untuk 'Area Penjualan'
            $table->string('whatsapp');         // Untuk 'Nomor WhatsApp'
            $table->string('photo_path')->nullable(); // Untuk 'Foto Sales'
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_contacts');
    }
};