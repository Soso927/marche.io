<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment',
        'is_approved',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_approved' => 'boolean',
    ];

    // l'utilisateur qui a laissé l'avis
    public function user()
    {
        return $this->belongsTo(user::class);
    }

    // le produit concerné 
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Scope pour récupérer uniquement les avis approuvés 
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }
}
