@extends('layouts.app')

@section('content')
<div class="product-detail-container">
    <link rel="stylesheet" href="show.css">
</head>

    <div class="breadcrumb">
        <a href="{{ route('products.index') }}">商品一覧</a> > {{ $product->name }}
        
    </div>

    <div class="product-detail-box">

        {{-- 左側：商品画像 --}}
        <div class="product-image-area">
            <img src="{{ asset('storage/img/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
            
            <label class="file-label">
                ファイルを選択
                <input type="file" name="image" class="file-input">
            </label>
        </div>

        {{-- 右側：商品データ編集フォーム --}}
        <div class="product-info-area">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- 商品名 --}}
                <div class="form-group">
                    <label>商品名</label>
                    <input type="text" name="name" value="{{ $product->name }}" class="form-input">
                </div>

                {{-- 値段 --}}
                <div class="form-group">
                    <label>値段</label>
                    <input type="number" name="price" value="{{ $product->price }}" class="form-input">
                </div>

                {{-- 季節 --}}
                <div class="form-group">
                    <label>季節</label>
                    <div class="season-radio">
                        @foreach($seasons as $season)
                            <label>
                                <input type="radio" name="season_id" value="{{ $season->id }}"
                                    {{ $product->season_id == $season->id ? 'checked' : '' }}>
                                {{ $season->name }}
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- 説明 --}}
                <div class="form-group">
                    <label>商品説明</label>
                    <textarea name="description" rows="6" class="form-textarea">
                        {{ $product->description }}
                    </textarea>
                </div>

                {{-- ボタン --}}
                <div class="button-area">
                    <a href="{{ route('products.index') }}" class="btn btn-gray">戻る</a>

                    <button class="btn btn-yellow" type="submit">変更を保存</button>

                    {{-- 削除 --}}
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-delete" onclick="return confirm('本当に削除しますか？')">
                            削除
                        </button>
                    </form>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection
