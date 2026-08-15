<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'type',
        'quantity',
        'reference_id',
        'reason',
        'created_by'
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getTypeLabel()
    {
        return match($this->type) {
            'in' => '📥 Stock In',
            'out' => '📤 Stock Out',
            'adjustment' => '⚙️ Adjustment',
            'return' => '↩️ Return',
            'damage' => '⚠️ Damage',
            default => $this->type
        };
    }
}
