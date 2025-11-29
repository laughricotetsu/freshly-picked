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
                <!-- ファイルを選択 -->
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
            </div>
        </form>
                    {{-- 削除 --}}
        <form action="{{ route('products.delete', $product->id) }}" method="POST" class="delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-icon-btn">
        <img src="{{ asset('public/storage/img/trash.png') }}" alt="削除" class="delete-icon">
            </button>
        </form>
        </div>
    </div>
</div>
</div>
@endsection
