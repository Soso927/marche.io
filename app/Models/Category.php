<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

      protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'icon',
    ];

    // La catégorie parente
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Les sous-catégories
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Les produits de cette catégorie
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
