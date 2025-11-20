@extends('layouts.app')

@section('content')
<h1>商品一覧</h1>

<a href="/products/register">新規登録</a>

<form action="/products/search" method="GET" style="margin-top:20px;">
    <input type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
    <button type="submit">検索</button>
</form>

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
                <button type="submit" onclick="return confirm('削除しますか？')">削除</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
{{ $products->links() }}
@endsection
