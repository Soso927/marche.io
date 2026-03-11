<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    /** @use HasFactory<\Database\Factories\ShopFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'logo',
        'is_active',
        'commission_rate',
    ];

    // le vendeur propriétaire de la boutique 
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // les produits de la boutique
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // les virements de la boutique 
    public function payouts()
    {
        return $this->hasMany(Payout::class);
    }
}
