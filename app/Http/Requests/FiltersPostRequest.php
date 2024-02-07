<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FiltersPostRequest extends FormRequest
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
            'filterName' => 'max:100',
            'minPrice' => '',
            'maxPrice' => '',
            'orderBy' => '',
        ];
    }

    public function messages()
    {
        return [
            'filterName.max' => "Trop de caractère"
        ];
    }
}
