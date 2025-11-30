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
            'name' => 'required|string|max:255',
        'price' => 'required|integer|min:0|max:10000',
        'season_id' => 'required|array',
        'description' => 'required|string|max:120',
        'image' => 'nullable|image|mimes:jpeg,png',
        ];
    }
    public function messages()
{
        return [
            'name.required' => '商品名を入力してください',
        'price.required' => '値段を入力してください',
        'price.integer' => '数値で入力してください',
        'price.min' => '0円以上を入力してください',
        'price.max' => '10000円以内で入力してください',
        'season_id.required' => '季節を選択してください',
        'description.required' => '商品説明を入力してください',
        'description.max' => '120文字以内で入力してください',
        'image.image' => '画像ファイルを選択してください',
        'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
    ];
    }
}



