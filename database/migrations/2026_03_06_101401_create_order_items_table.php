<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('shop_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->timestamps();
        });
        ## Ce que fait chaque ligne

// - `foreignId('order_id')` — cette ligne appartient à une commande
// - `foreignId('product_id')` — quel produit a été commandé
// - `foreignId('shop_id')` — de quelle boutique vient ce produit. C'est important car une commande peut contenir des produits de **plusieurs boutiques différentes**
// - `unsignedInteger('quantity')` — combien d'unités ont été commandées, jamais négatif
// - `decimal('unit_price', 10, 2)` — le prix **au moment de la commande**. Très important ! Si le vendeur change son prix plus tard, la commande garde l'historique du vrai prix payé

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
