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

<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>商品名:</label><br>
    <input type="text" name="name" value="{{ old('name', $product->name) }}"><br><br>

    <label>価格:</label><br>
    <input type="number" name="price" value="{{ old('price', $product->price) }}"><br><br>

    {{-- 季節 --}}
    <label>季節（複数選択可）</label>
    <div>
        @foreach($seasons as $season)
            <label>
                <input type="checkbox"
                    name="season_id[]"
                    value="{{ $season->id }}"
                    {{ in_array($season->id, $product->seasons->pluck('id')->toArray()) ? 'checked' : '' }}>
                {{ $season->name }}
            </label>
        @endforeach
    </div>

    <button type="submit">更新</button>
</form>

<a href="/products/{{ $product->id }}">詳細へ戻る</a>
@endsection
