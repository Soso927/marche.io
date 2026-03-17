<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer ma boutique
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">

                {{-- @if($errors->any()) affiche tous les messages d'erreur de validation --}}
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <ul class="list-disc list-inside text-red-600 text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- enctype="multipart/form-data" est OBLIGATOIRE pour uploader des fichiers --}}
                <form method="POST"
                      action="{{ route('seller.shop.store') }}"
                      enctype="multipart/form-data">

                    {{-- @csrf génère un token de sécurité invisible contre les attaques --}}
                    @csrf

                    {{-- Champ nom de la boutique --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nom de la boutique *
                        </label>
                        {{-- old('name') réaffiche la valeur si le formulaire est resoumis après erreur --}}
                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500"
                               placeholder="Ex: La Boutique de Marie">
                    </div>

                    {{-- Champ description --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>
                        <textarea name="description"
                                  rows="4"
                                  class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500"
                                  placeholder="Décrivez votre boutique en quelques mots...">{{ old('description') }}</textarea>
                    </div>

                    {{-- Champ logo --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Logo de la boutique
                        </label>
                        <input type="file"
                               name="logo"
                               accept="image/*"
                               class="w-full text-sm text-gray-500">
                        <p class="text-xs text-gray-400 mt-1">
                            Format accepté : JPG, PNG, WEBP. Taille max : 2 Mo.
                        </p>
                    </div>

                    {{-- Bouton de soumission --}}
                    <div class="flex justify-end">
                        <button type="submit"
                                class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                            Créer ma boutique
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>