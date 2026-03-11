<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    /** @use HasFactory<\Database\Factories\PayoutFactory> */
    use HasFactory;
    protected $fillable = [
        'shop_id',
        'amount',
        'status',
        'stripe_transfer_id',
        'processed_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'processed_at' => 'datetime',
    ];

    // La boutique qui reçoit le virement
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    // Scope pour les virements en attente
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Scope pour les virements complétés
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }


}
