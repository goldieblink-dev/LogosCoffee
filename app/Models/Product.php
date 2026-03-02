<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'image',
        'is_available',
        'promo_price',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getIsPromoAttribute()
    {
        return $this->promo_price !== null && $this->promo_price > 0;
    }
}