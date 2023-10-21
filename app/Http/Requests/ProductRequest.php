<?php

namespace App\Http\Requests;

use App\Traits\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    use RequestTrait;
    /**
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|decimal:0,2',
            'promotional_price' => 'nullable|decimal:0,2',
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
