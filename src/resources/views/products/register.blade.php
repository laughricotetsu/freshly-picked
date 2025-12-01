@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush

@section('content')
<div class="container">

    <h2 class="title">商品登録</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 商品名 -->
        <div class="form-group">
            @error('name')
                <p class="error-text">{{ $message }}</p>
            @enderror

            <label>商品名 <span class="required">必須</span></label>
            <input type="text" name="name" class="form-control"
                   placeholder="商品名を入力してください" value="{{ old('name') }}" />
        </div>

        <!-- 価格 -->
        <div class="form-group">

            @error('price')
                <p class="error-text">{{ $message }}</p>
            @enderror
            @error('price_numeric')
                <p class="error-text">{{ $message }}</p>
            @enderror
            @error('price_between')
                <p class="error-text">{{ $message }}</p>
            @enderror

            <label>価格 <span class="required">必須</span></label>
            <input type="number" name="price" class="form-control"
                   placeholder="例: 800" value="{{ old('price') }}" />
        </div>

        <!-- 商品画像 -->
        <div class="form-group">

            @error('image')
                <p class="error-text">{{ $message }}</p>
            @enderror

            <label>商品画像 <span class="required">必須</span></label>
            <input type="file" name="image" class="form-control" />
        </div>

        <!-- 季節 -->
        <div class="form-group">

            @error('season_id')
                <p class="error-text">{{ $message }}</p>
            @enderror

            <label>季節 <span class="required">必須</span></label>

            <div class="season-checkbox">
                @foreach ($seasons as $season)
                    <label>
                        <input type="checkbox" name="season_id[]" value="{{ $season->id }}"
                               {{ (is_array(old('season_id')) && in_array($season->id, old('season_id'))) ? 'checked' : '' }}>
                        {{ $season->name }}
                    </label>
                @endforeach
            </div>
        </div>

        <!-- 商品説明 -->
        <div class="form-group">

            @error('description')
                <p class="error-text">{{ $message }}</p>
            @enderror

            <label>商品説明 <span class="required">必須</span></label>
            <textarea name="description" class="form-control"
                      placeholder="商品の説明を入力してください（120文字以内）">{{ old('description') }}</textarea>
        </div>

        <div class="button-area">
            <a href="{{ route('products.index') }}" class="btn-submit btn-gray">戻る</a>
            <button type="submit" class="btn-submit">登録</button>
        </div>
    </form>
</div>
@endsection
