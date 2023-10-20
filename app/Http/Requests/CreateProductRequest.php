<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|decimal:0,2',
            'promotional_price' => 'decimal:0,2',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'O título é obrigatório.',
            'description.required' => 'A descrição é obrigatória.',
            'price.required' => 'É obrigatório informar um preço.',
            'price.decimal' => 'Formato do campo de preço inválido',
            'promotional_price' => 'Formato do campo de preço promocional inválido.',
        ];
    }
}
