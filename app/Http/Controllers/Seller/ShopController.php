<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Models\Shop;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    // Affiche la boutique du vendeur connecté
    public function index()
    {
        $shop = auth()->user()->shop;
        return view('seller.shop.index', compact('shop'));
    }

    // Affiche le formulaire de création de boutique
    public function create()
    {
        // Si le vendeur a déjà une boutique, on le redirige
        if (auth()->user()->shop) {
            return redirect()->route('seller.shop.index')
                ->with('info', 'Vous avez déjà une boutique.');
        }
        return view('seller.shop.create');
    }

    // Enregistre la nouvelle boutique en base de données
    public function store(StoreShopRequest $request)
    {
        $logoPath = null;

        // Si un logo a été uploadé, on le traite avec Intervention Image
        if ($request->hasFile('logo')) {
            $image = Image::read($request->file('logo'));

            // On redimensionne à 400x400 pixels maximum
            $image->scaleDown(400, 400);

            // On génère un nom unique pour éviter les conflits
            $filename = 'logo_' . Str::uuid() . '.webp';

            // On sauvegarde dans storage/app/public/shops/logos/
            Storage::disk('public')->put(
                'shops/logos/' . $filename,
                $image->toWebp(80)
            );

            $logoPath = 'shops/logos/' . $filename;
        }

        // On crée la boutique en base de données
        Shop::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'logo' => $logoPath,
            'is_active' => false, // En attente de validation par l'admin
        ]);

        return redirect()->route('seller.dashboard')
            ->with('success', 'Votre boutique a été créée ! Elle sera visible après validation.');
    }

    // Affiche le formulaire de modification
    public function edit(Shop $shop)
    {
        // On vérifie que le vendeur modifie bien SA boutique
        $this->authorize('update', $shop);
        return view('seller.shop.edit', compact('shop'));
    }

    // Met à jour la boutique en base de données
    public function update(UpdateShopRequest $request, Shop $shop)
    {
        $this->authorize('update', $shop);

        $logoPath = $shop->logo; // On garde l'ancien logo par défaut

        if ($request->hasFile('logo')) {
            // On supprime l'ancien logo pour ne pas encombrer le stockage
            if ($shop->logo) {
                Storage::disk('public')->delete($shop->logo);
            }

            $image = Image::read($request->file('logo'));
            $image->scaleDown(400, 400);
            $filename = 'logo_' . Str::uuid() . '.webp';
            Storage::disk('public')->put(
                'shops/logos/' . $filename,
                $image->toWebp(80)
            );
            $logoPath = 'shops/logos/' . $filename;
        }

        $shop->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'logo' => $logoPath,
        ]);

        return redirect()->route('seller.dashboard')
            ->with('success', 'Votre boutique a été mise à jour.');
    }
}