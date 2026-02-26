<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductCategory extends Model
{
    protected $fillable = ['slug', 'name_id', 'name_en'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
