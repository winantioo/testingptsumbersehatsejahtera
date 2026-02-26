<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SalesContact extends Model
{
    // 1. area_en dihapus dari fillable
    protected $fillable = ['name', 'area_id', 'whatsapp', 'photo_path'];

    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo_path ? asset('storage/' . ltrim($this->photo_path, '/')) : null;
    }

    // 2. Fungsi ini disederhanakan karena kita hanya pakai area_id sekarang
    public function getAreaAttribute(): string
    {
        return $this->area_id;
    }

    public function getWaAttribute(): string
    {
        return $this->whatsapp;
    }

    public function getWhatsappLinkAttribute(): string
    {
        $num = preg_replace('/[^0-9]/', '', $this->whatsapp);
        if (str_starts_with($num, '0')) $num = '62' . substr($num, 1);
        return 'https://wa.me/' . $num;
    }
}