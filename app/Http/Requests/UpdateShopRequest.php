<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class UpdateShopRequest extends FormRequest
{
public function authorize(): bool
{
    /** @var User $user */
    $user = auth()->user();

    return $user->id === $this->route('shop')->user_id;
}

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],

            // 'sometimes' signifie : valide CE champ seulement s'il est présent dans la requête
            // Ainsi le vendeur peut modifier sa description sans re-uploader son logo
            'logo' => ['sometimes', 'nullable', 'image', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom de la boutique est obligatoire.',
            'name.min' => 'Le nom doit contenir au moins 3 caractères.',
            'logo.image' => 'Le logo doit être une image.',
            'logo.max' => 'Le logo ne doit pas dépasser 2 Mo.',
        ];
    }
}