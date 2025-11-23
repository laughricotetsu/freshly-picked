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
        <form>
            <input type="text" placeholder="商品名で検索" class="search-input">
            <button class="search-btn">検索</button>
            <label class="price-label">価格順で表示</label>
            <select class="price-select">
            <option>選択してください</option>
            <option value="low">安い順</option>
            <option value="high">高い順</option>
            </select>
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