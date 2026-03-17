<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier ma boutique
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">

                {{-- Affichage des erreurs de validation --}}
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <ul class="list-disc list-inside text-red-600 text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- 
                    @method('PUT') est obligatoire car les formulaires HTML
                    ne supportent que GET et POST nativement.
                    Laravel intercepte ce champ caché pour simuler une requête PUT.
                --}}
                <form method="POST"
                      action="{{ route('seller.shop.update', $shop) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Champ nom — old() réaffiche la valeur en cas d'erreur,
                         sinon affiche le nom actuel de la boutique --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nom de la boutique *
                        </label>
                        <input type="text"
                               name="name"
                               value="{{ old('name', $shop->name) }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500">
                    </div>

                    {{-- Champ description --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>
                        <textarea name="description"
                                  rows="4"
                                  class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500">{{ old('description', $shop->description) }}</textarea>
                    </div>

                    {{-- Champ logo avec aperçu de l'actuel --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Logo de la boutique
                        </label>

                        {{-- On affiche le logo actuel si il existe --}}
                        @if($shop->logo)
                            <div class="mb-3">
                                <p class="text-xs text-gray-500 mb-2">Logo actuel :</p>
                                <img src="{{ Storage::url($shop->logo) }}"
                                     alt="Logo actuel"
                                     class="w-20 h-20 rounded-full object-cover">
                            </div>
                        @endif

                        <input type="file"
                               name="logo"
                               accept="image/*"
                               class="w-full text-sm text-gray-500">
                        <p class="text-xs text-gray-400 mt-1">
                            Laisse vide pour conserver le logo actuel.
                        </p>
                    </div>

                    {{-- Boutons d'action --}}
                    <div class="flex justify-between items-center">
                        {{-- Retour sans sauvegarder --}}
                        <a href="{{ route('seller.shop.index') }}"
                           class="text-gray-500 hover:text-gray-700 transition">
                            Annuler
                        </a>

                        <button type="submit"
                                class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                            Sauvegarder les modifications
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>