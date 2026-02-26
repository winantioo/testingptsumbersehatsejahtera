<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = ['logo_path'];

    // Accessor untuk memanggil gambar di Blade (seperti yang kita pasang di frontend tadi)
    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo_path ? asset('storage/' . ltrim($this->logo_path, '/')) : null;
    }
}