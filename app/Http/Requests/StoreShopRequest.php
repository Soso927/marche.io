<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreShopRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
      public function authorize(): bool
    {
        // On récupère l'utilisateur en précisant son type
        /** @var User $user */
        $user = auth()->user();

        return $user->hasRole('seller');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // le nom est obligatoire, texte uniquement, 3 à 255 caractères
            'name' => ['required', 'string', 'min:3', 'max:255'],
            // la description est optionnelle mais limitée à 1000 caractères
            'description' => ['nullable', 'string', 'max:1000'],
            // le logo est optionnel, doit être une image de moins de 2Mo
            'logo' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            // messages d'erreur en français pour l'utilisateur
            'name.required' => 'le nom de la boutique est obligatoire',
            'name.min' => 'Le nom doit contenir au moins 3 caractères', 
            'logo.image' => 'le logo doit être une image.',
            'logo.max' => 'Le logo ne doit pas dépasser 2 Mo.',
        ];
    }
}
