<?php

namespace App\Providers;

use App\Models\Shop;
use App\Policies\ShopPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // On dit à Laravel : pour le modèle Shop, utilise ShopPolicy
        Gate::policy(Shop::class, ShopPolicy::class);
    }
}