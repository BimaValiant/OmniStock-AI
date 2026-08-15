<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'po_code',
        'supplier_id',
        'status',
        'total_amount',
        'order_date',
        'expected_delivery',
        'received_date',
        'notes',
        'created_by'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'order_date' => 'date',
        'expected_delivery' => 'date',
        'received_date' => 'date',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class, 'purchase_order_id');
    }

    public function getStatusLabel()
    {
        return match($this->status) {
            'draft' => '📝 Draft',
            'pending' => '⏳ Pending',
            'ordered' => '📦 Ordered',
            'partially_received' => '📬 Partially Received',
            'received' => '✅ Received',
            'cancelled' => '❌ Cancelled',
            default => $this->status
        };
    }

    public function getStatusColor()
    {
        return match($this->status) {
            'draft' => 'bg-slate-600',
            'pending' => 'bg-yellow-600',
            'ordered' => 'bg-blue-600',
            'partially_received' => 'bg-amber-600',
            'received' => 'bg-emerald-600',
            'cancelled' => 'bg-red-600',
            default => 'bg-slate-500'
        };
    }
}
