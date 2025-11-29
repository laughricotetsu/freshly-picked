@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/create.css')}}">
@endpush

@section('content')
<div class="container">

    <h2 class="title">商品登録</h2>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 商品名 -->
        <div class="form-group">
            <p>@error('name') {{ $message }} @enderror</p>
            <label>商品名 <span class="required">必須</span></label>
            <input type="text" name="name" class="form-control" placeholder="商品名を入力" value="{{ old('name') }}" />
        </div>

        <!-- 価格 -->
        <div class="form-group">
            <p>@error('price') {{ $message }} @enderror</p>
            <p>@error('price_numeric') {{ $message }} @enderror</p>
            <p>@error('price_between') {{ $message }} @enderror</p>

            <label>価格 <span class="required">必須</span></label>
            <input type="number" name="price" class="form-control" placeholder="例: 800" value="{{ old('price') }}" />
        </div>

        <!-- 商品画像 -->

        <div class="form-group">
            @error('image')
            <p>{{ $message }}</p>
            @enderror

                <label>商品画像 <span class="required">必須</span></label>
                <input type="file" name="image" class="form-control" />
</div>

        <!-- 季節 -->
        <div class="form-group">
            @error('season_id')
                {{ $message }}
            @enderror

            <label>季節（複数選択可）</label>
            <div class="season-checkbox">
                @forelse ($seasons as $season)
                    <label>
                        <input type="checkbox"
                            name="season_id[]"
                            value="{{ $season->id }}"
                            {{ (is_array(old('season_id')) && in_array($season->id, old('season_id'))) ? 'checked' : '' }}>
                        {{ $season->name }}
                    </label>
                @empty
                    <p>季節情報がありません。</p>
                @endforelse
            </div>
        </div>

        <!-- 商品説明 -->
        <div class="form-group">
            <label>商品説明 <span class="required">必須</span></label>

            <textarea name="description" class="form-control" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
        </div>

        <div class="button-area">
            <a href="{{ route('products.index') }}" class="btn-submit">戻る</a>
            <button type="submit" class="btn btn-submit">登録</button>
        </div>
    </form>
</div>
@endsection
