<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'total_amount',
        'status',
        'stripe_payment_id',
        'shipped_at',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'shipped_at' => 'datetime',
    ];

    public function buyer()
    {
        return $this->belongsTo(User::class,'buyer_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
