@extends('layouts.app')

@section('content')
<h1>商品登録</h1>

@if ($errors->any())
    <div style="color:red;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form action="/products/register" method="POST">
    @csrf

    <label>商品名:</label><br>
    <input type="text" name="name" value="{{ old('name') }}"><br><br>

    <label>価格:</label><br>
    <input type="number" name="price" value="{{ old('price') }}"><br><br>

    <button type="submit">登録</button>
</form>

<a href="/products">一覧へ戻る</a>
@endsection
