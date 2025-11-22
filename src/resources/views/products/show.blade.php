@extends('layouts.app')

@section('content')
<h1>商品詳細</h1>

<p>ID: {{ $product->id }}</p>
<img src="{{ asset('storage/img/' . $product->image) }}" alt="{{ $product->name }}">
<p>商品名: {{ $product->name }}</p>
<p>価格: {{ $product->price }}円</p>
<p>商品説明 {{ $product->description }}</p>

<a href="/products/{{ $product->id }}/update">編集</a>
<a href="/products">一覧へ戻る</a>
@endsection
