<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'  => 'required',
            'price' => 'required|integer|min:0|max:10000',
            'season_id'   => 'required|array',
            'season_id.*' => 'integer|exists:seasons,id',
            'description' => 'required',
            'description_max' => 'required|string|max:120',
            'image'  => 'required|image|mimes:jpeg,png,
        ];
    }

    public function messages()
    {
        return [
            'name.required'  => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.integer'  => '数値で入力してください',
            'price_between.required' => '0~10000円以内で入力してください',
            'season.required' => '季節を選択してください',
            'description.required' => '商品説明を入力してください',
            'description_max.required' => '120文字以内で入力してください',
            'image.required' => '商品画像を登録してください',
            'image_format.required' => '「.png」または「.jpeg」形式でアップロードしてください',
        ];
    }
}
