@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endpush

@section('content')
<div class="product-detail-container">

    <div class="breadcrumb">
        <a href="{{ route('products.index') }}">商品一覧</a> > {{ $product->name }}（編集）
    </div>

    <div class="product-detail-box">

        {{-- 左側（画像 + ファイル選択） --}}
        <div class="product-image-area">
            <img src="{{ asset('storage/img/' . $product->image) }}"
                alt="{{ $product->name }}"
                class="product-image">

            <label class="file-label">
                ファイルを選択
                <input type="file" name="image" class="file-input" form="update-form">
            </label>

            @error('image')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        {{-- 右側（商品情報フォーム） --}}
        <div class="product-info-area">
            <form id="update-form"
                  action="{{ route('products.update', $product->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- 商品名 --}}
                <div class="form-group">
                    <label>商品名</label>
                    <input type="text" name="name" 
                           value="{{ old('name', $product->name) }}" 
                        class="form-input">
                    @error('name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 値段 --}}
                <div class="form-group">
                    <label>値段</label>
                    <input type="number" name="price"
                        value="{{ old('price', $product->price) }}"
                        class="form-input">
                    @error('price')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 季節 --}}
                <div class="form-group">
                    <label>季節（複数選択可）</label>
                    <div class="season-checkbox">
                        @foreach ($seasons as $season)
                            <label>
                                <input type="checkbox"
                                    name="season_id[]"
                                    value="{{ $season->id }}"
                                    {{ in_array($season->id, old('season_id', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
                                {{ $season->name }}
                            </label>
                        @endforeach
                    </div>
                    @error('season_id')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 説明 --}}
                <div class="form-group">
                    <label>商品説明</label>
                    <textarea name="description"
                            rows="6"
                            class="form-textarea">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ボタン --}}
                <div class="button-area">
                    <a href="{{ route('products.index') }}" class="btn btn-gray">戻る</a>
                    <button class="btn btn-yellow" type="submit">変更を保存</button>
                </div>
            </form>

            {{-- 削除 --}}
            <form action="{{ route('products.delete', $product->id) }}"
                method="POST"
                class="delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-icon-btn">
                    <img src="{{ asset('storage/img/trash.png') }}"
                        alt="削除" class="delete-icon">
                </button>
            </form>

        </div>
    </div>
</div>
@endsection
