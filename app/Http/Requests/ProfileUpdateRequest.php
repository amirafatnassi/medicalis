<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */

    public function rules()
    {
        return [
            'sexe_id' => 'required',
            'nom' => 'required',
            'prenom' => 'required',
            'datenaissance' => 'required',
            'email' => 'required',
            'pays' => 'required',
            'ville' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'sexe_id.required' => 'Le champ sexe est requis.',
            'nom.required' => 'Le champ nom est requis.',
            'prenom.required' => 'Le champ prénom est requis.',
            'datenaissance.required' => 'Le champ date de naissance est requis.',
            'email' => 'Le champ email est requis.',
            'ville_id' => 'Le champ ville est requis.',
            'country_id' => 'Le champ pays est requis.',
            'image' => 'Le champ :attribute doit être une image au format jpeg, png, jpg ou gif et ne pas dépasser 2048 Ko.',
        ];
    }
}
