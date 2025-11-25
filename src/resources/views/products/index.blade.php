@extends('layouts.app')

@section('content')
<div class="container">

<title>商品一覧</title>
  <link rel="stylesheet" href="index.css">
</head>
<body>

  <header class="header">
    <h1 class="logo">mogitate</h1>
  </header>

  <div class="container">
    <h2 class="page-title">商品一覧</h2>
    <a href="{{ route('products.create') }}" class="add-btn">＋ 商品を追加</a>

    <div class="main-content">

        <!-- 左側：検索エリア -->
    <aside class="sidebar">
    <form action="{{ route('products.index') }}" method="GET">
        <div class="form-group">
        <input type="text" placeholder="商品名で検索" class="search-input">
            <button class="search-btn">検索</button>
            <label for="sort">価格順で表示</label>
            <select name="sort" id="sort" class="form-control">
                <option value="">選択してください</option>
                <option value="price_desk"  {{ request('sort') == 'price_desk' ? 'selected' : '' }}>価格が高い順</option>
             <option value="price_asc" {{ request('sort')=='price_asc' ? 'selected' : '' }}>
                価格が低い順
            </option>
            </select>
        </div>   
    </form>
    </aside>

        <!-- 右側：商品一覧 -->
    <section class="product-list">
            @foreach ($products as $product)
            <a href="{{ route('products.show', $product->id) }}" class="product-card-link">
                <div class="product-card">
                    <img src="{{ asset('storage/img/' . $product->image) }}" alt="{{ $product->name }}">
                    <span class="name">{{ $product->name }}</span>
                    <span class="price">¥{{ number_format($product->price) }}</span>
                </div>
            @endforeach
        </section>
    </div>

    <div class="pagination">
        {{ $products->links() }}
    </div>

</div>
@endsection