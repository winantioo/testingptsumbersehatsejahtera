<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    // --- PERBAIKAN DI SINI ---
    // Tambahkan 'slug' agar bisa disimpan saat Import Excel
    protected $fillable = [
        'name',
        'slug',          // <--- WAJIB ADA
        'category_id',
        'manufacturer',
        'image_path',
        'is_active',     // Tambahkan jika kamu punya kolom status aktif
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    // Accessor untuk URL Gambar
    public function getImageUrlAttribute(): ?string
    {
        if (! $this->image_path) return null;

        return asset('storage/' . ltrim($this->image_path, '/'));
    }

    // Accessor supaya blade yang pakai $p->type tetap aman
    public function getTypeAttribute(): ?string
    {
        return $this->category?->name_id;
    }
}