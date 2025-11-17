<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'  => 'required|string|max:255',
            'price' => 'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'name.required'  => '商品名は必須です。',
            'price.required' => '価格は必須です。',
            'price.integer'  => '価格は数値で入力してください。',
        ];
    }
}
