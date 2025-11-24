@extends('layouts.app')

@section('content')

<div class="container" style="max-width: 600px;">
    <h2>商品登録</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 商品画像 -->
        <div class="form__error">
            <p>@error('image')
            {{ $message }}
            @enderror</p>
            <p>@error('image_format')
            {{ $message }}
            @enderror</p>
            <label>商品画像</label>
            <input type="file" name="image" class="form-control" value="{{ old('image') }}" />
<!--省略-->
        </div>

        <!-- 商品名 -->
        <div class="form__error">
            <p>@error('name')
            {{ $message}}
            @enderror</p>
            <label>商品名</label>
            <input type="text" name="name" class="form-control" placeholder="商品名を入力" value="{{ old('name') }}" />
        </div>

        <!-- 価格 -->
        <div class="form__error">
            <p>@error('price')
            {{ $message }}
            @enderror</p>
            <p>@error('price_numeric')
            {{ $message }}
            @enderror</p>
            <p>@error('price_between')
            {{ $message }}
            @enderror</p>
            <label>価格</label>
            <input type="number" name="price" class="form-control" placeholder="例: 800" value="{{ old('price') }}" />
        </div>
        <!-- 説明 -->
        <div class="form__error">
            <P>@error('description')
            {{ $message }}
            @enderror</p>
            <p>@error('description_max')
            {{ $message }}
            @enderror</p>
            <label>商品説明</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>
        
{{-- 季節 --}}
<div class="form__error">
    @error('season')
    {{ $message }}
    @enderror
    <label>季節</label>
    <div class="season-radio">
        @forelse ($seasons as $season)
            <label>
                <input type="radio" name="season_id" value="{{ $season->id }}"
                    {{ old('season_id') == $season->id ? 'checked' : '' }}>
                {{ $season->name }}
            </label>
        @empty
            <p>季節情報がありません。</p>
        @endforelse
    </div>
</div>


         <a href="{{ route('products.index') }}" class="add-btn">戻る</a>
        <button type="submit" class="btn btn-primary">変更を保存</button>
    </form>
</div>
@endsection
