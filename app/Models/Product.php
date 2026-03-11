<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** * Utilisation du trait HasFactory pour permettre la création de "factories" 
     * (utile pour générer des données de test). 
     */
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    /**
     * Mass Assignment : Liste des attributs que l'on autorise à remplir 
     * via la méthode Product::create([]) ou $product->update([]).
     */
    protected $fillable = [
        'shop_id',      // Clé étrangère vers la boutique
        'category_id',  // Clé étrangère vers la catégorie
        'name',         // Nom du produit
        'slug',         // Version URL-friendly du nom
        'description',  // Description détaillée
        'price',        // Prix du produit
        'stock',        // Quantité disponible
        'images',       // Chemins des images (stockés en JSON/Array)
        'is_active',    // État de visibilité du produit
    ];

    /**
     * Casting d'attributs : Convertit automatiquement les colonnes de la BDD 
     * en types de données PHP spécifiques lors de l'accès.
     */
    protected $casts = [
        'images' => 'array',       // Transforme le JSON de la BDD en tableau PHP
        'price' => 'decimal:2',    // Force le prix avec 2 décimales (évite les erreurs de calcul)
        'is_active' => 'boolean',  // Transforme 0/1 en true/false
    ];

    /**
     * RELATION : Un produit appartient à une boutique (Many-to-One).
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    /**
     * RELATION : Un produit appartient à une catégorie (Many-to-One).
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * RELATION : Un produit peut avoir plusieurs avis clients (One-to-Many).
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * RELATION : Un produit peut apparaître dans plusieurs lignes de commande (One-to-Many).
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}