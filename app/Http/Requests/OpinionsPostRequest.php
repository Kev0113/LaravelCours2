<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OpinionsPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'opinion' => 'required|max:500',
            'rate' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'opinion.required' => "Vous n'avez pas rempli de commentaire avis",
            'opinion.max' => "Vous avis doit faire moins de 500 caracteres",
            'rate.required' => "Vous devez mettre une note"
        ];
    }
}
