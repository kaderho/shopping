<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProduitRequest extends FormRequest
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
            'nom' => 'bail|required|max:100',
            'label' => 'bail|required|max:100',
            'details' => 'bail|required|max:255',
            'prix' => 'bail|required',
            'quantity' => 'bail|required',
            'description' => 'bail|required',
            'photo' => 'bail|required|image|mimes:jpg,jpeg,png'
        ];
    }
}
