<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'category_id',
        'stock',
        'min_stock_alert',
        'selling_price',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}