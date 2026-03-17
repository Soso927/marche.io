<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ma boutique
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Message de succès après création ou modification --}}
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Si le vendeur n'a pas encore de boutique --}}
            @if(!$shop)
                <div class="bg-white shadow-xl rounded-lg p-8 text-center">
                    <h3 class="text-lg font-bold text-gray-700 mb-4">
                        Vous n'avez pas encore de boutique 
                    </h3>
                    <a href="{{ route('seller.shop.create') }}"
                       class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                        Créer ma boutique
                    </a>
                </div>

            {{-- Si le vendeur a une boutique --}}
            @else
                <div class="bg-white shadow-xl rounded-lg p-8">

                    {{-- En-tête avec logo et nom --}}
                    <div class="flex items-center gap-6 mb-6">
                        @if($shop->logo)
                            <img src="{{ Storage::url($shop->logo) }}"
                                 alt="Logo {{ $shop->name }}"
                                 class="w-24 h-24 rounded-full object-cover">
                        @else
                            {{-- Placeholder si pas de logo --}}
                            <div class="w-24 h-24 rounded-full bg-indigo-100 flex items-center justify-center">
                                <span class="text-3xl">🏪</span>
                            </div>
                        @endif

                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">
                                {{ $shop->name }}
                            </h3>

                            {{-- Badge statut boutique --}}
                            @if($shop->is_active)
                                <span class="text-green-600 text-sm font-medium">
                                     Boutique active
                                </span>
                            @else
                                <span class="text-orange-500 text-sm font-medium">
                                     En attente de validation par l'admin
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Description --}}
                    @if($shop->description)
                        <p class="text-gray-600 mb-6">{{ $shop->description }}</p>
                    @endif

                    {{-- Bouton modifier --}}
                    <a href="{{ route('seller.shop.edit', $shop) }}"
                       class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                        Modifier ma boutique
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>