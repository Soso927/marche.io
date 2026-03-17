<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Espace Vendeur
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- 
                session('success') vérifie si un message flash de type 'success'
                existe dans la session. S'il existe, on l'affiche et il est
                automatiquement supprimé par Laravel après cette requête.
            --}}
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Message d'information --}}
            @if(session('info'))
                <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg text-blue-700">
                    {{ session('info') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Bienvenue {{ auth()->user()->name }} 👋</h3>
                <p class="text-gray-600">Vous êtes connecté en tant que <strong>vendeur</strong>.</p>

                {{-- Lien vers la boutique --}}
                <div class="mt-6">
                    <a href="{{ route('seller.shop.index') }}"
                       class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                        Gérer ma boutique
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>