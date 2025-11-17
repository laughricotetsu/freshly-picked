@extends('layouts.app')

@section('content')
<h1>検索結果</h1>

<form action="/products/search" method="GET">
    <input type="text" name="keyword" value="{{ $keyword }}">
    <button type="submit">再検索</button>
</form>

@if ($products->count() === 0)
    <p>該当する商品がありません。</p>
@else
    <table border="1" style="margin-top:20px;">
        <tr>
            <th>ID</th>
            <th>商品名</th>
            <th>価格</th>
            <th>操作</th>
        </tr>

        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td><a href="/products/{{ $product->id }}">{{ $product->name }}</a></td>
            <td>{{ $product->price }}円</td>
            <td>
                <a href="/products/{{ $product->id }}/update">編集</a>
                <form action="/products/{{ $product->id }}/delete" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">削除</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endif

<a href="/products">一覧へ戻る</a>
@endsection
