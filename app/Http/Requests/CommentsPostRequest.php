<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentsPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'message' => 'required|max:500'
        ];
    }

    public function messages()
    {
        return [
            'message.required' => "Vous n'avez pas rempli le champ message",
            'message.max' => "Vous commentaire doit faire moins de 500 caracteres"
        ];
    }
}
