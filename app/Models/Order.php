<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'table_number',
        'customer_name',
        'customer_phone',
        'total_amount',
        'status',
        'payment_method',
        'payment_proof',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
                'pending' => 'Menunggu',
                'paid' => 'Dibayar',
                'processing' => 'Diproses',
                'completed' => 'Selesai',
                default => $this->status,
            };
    }

    public function scopeDaily($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeWeekly($query)
    {
        return $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
    }

    public function scopeMonthly($query)
    {
        return $query->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
    }
}