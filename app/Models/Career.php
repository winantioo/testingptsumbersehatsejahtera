<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Career extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_id',
        'title_en',
        'description_id',
        'description_en',
        'image',
        'badge_text',
        'apply_url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}