<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品登録</title>
</head>
<body>

<h1>商品登録フォーム</h1>

<!-- エラーメッセージ -->
@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div>
        <label>商品名：</label><br>
        <input type="text" name="name" value="{{ old('name') }}">
    </div>

    <div>
        <label>価格：</label><br>
        <input type="number" name="price" value="{{ old('price') }}">
    </div>

    <div>
        <label>商品画像：</label><br>
        <input type="file" name="image">
    </div>

    <div>
        <label>説明文：</label><br>
        <textarea name="description">{{ old('description') }}</textarea>
    </div>

    <button type="submit">登録する</button>
</form>

</body>
</html>
