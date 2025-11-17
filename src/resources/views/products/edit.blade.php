@extends('layouts.app')

@section('content')
<h1>商品編集</h1>

@if ($errors->any())
    <div style="color:red;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form action="/products/{{ $product->id }}/update" method="POST">
    @csrf

    <label>商品名:</label><br>
    <input type="text" name="name" value="{{ old('name', $product->name) }}"><br><br>

    <label>価格:</label><br>
    <input type="number" name="price" value="{{ old('price', $product->price) }}"><br><br>

    <button type="submit">更新</button>
</form>

<a href="/products/{{ $product->id }}">詳細へ戻る</a>
@endsection
