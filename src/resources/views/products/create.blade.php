@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 600px;">
    <h2>商品登録</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 商品画像 -->
        <div class="form-group mb-3">
            <label>商品画像</label>
            <input type="file" name="image" class="form-control">
        </div>

        <!-- 商品名 -->
        <div class="form-group mb-3">
            <label>商品名</label>
            <input type="text" name="name" class="form-control" placeholder="商品名を入力">
        </div>

        <!-- 価格 -->
        <div class="form-group mb-3">
            <label>価格</label>
            <input type="number" name="price" class="form-control" placeholder="例: 800">
        </div>

        <!-- 説明 -->
        <div class="form-group mb-3">
            <label>説明</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">登録する</button>
    </form>
</div>
@endsection
