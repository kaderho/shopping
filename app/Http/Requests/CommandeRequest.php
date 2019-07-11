<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommandeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nom_prenom' => 'bail|required|max:150',
            'adresse' => 'bail|required|max:255',
            'email' => 'bail|required|email|max:100',
            'telephone' => 'bail|required|max:9',
        ];
    }
}
