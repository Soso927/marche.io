<?php

namespace App\Policies;

use App\Models\Shop;
use App\Models\User;

class ShopPolicy
{
    // Un admin peut tout faire sur toutes les boutiques
    // Cette méthode est vérifiée EN PREMIER avant toutes les autres
    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole('admin')) {
            return true; // L'admin passe toujours, on arrête les vérifications
        }
        return null; // Pour les autres, on continue vers les méthodes ci-dessous
    }

    // Qui peut voir la liste des boutiques ?
    public function viewAny(User $user): bool
    {
        return $user->hasRole('seller');
    }

    // Qui peut voir UNE boutique précise ?
    public function view(User $user, Shop $shop): bool
    {
        // Le propriétaire peut toujours voir sa boutique
        return $user->id === $shop->user_id;
    }

    // Qui peut créer une boutique ?
    public function create(User $user): bool
    {
        // Seul un vendeur sans boutique existante peut en créer une
        return $user->hasRole('seller') && !$user->shop;
    }

    // Qui peut modifier une boutique ?
    public function update(User $user, Shop $shop): bool
    {
        // Uniquement le propriétaire de la boutique
        return $user->id === $shop->user_id;
    }

    // Qui peut supprimer une boutique ?
    public function delete(User $user, Shop $shop): bool
    {
        // Uniquement le propriétaire
        return $user->id === $shop->user_id;
    }
}