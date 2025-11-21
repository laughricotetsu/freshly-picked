<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * 商品一覧
     */
    public function index()
    {
        $products = Product::simplePaginate(6);
        $items = Product::with('season')->get();

        return view('products.index',compact('products'));
    }

    /**
     * 商品登録フォーム表示
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * 商品登録処理
     */
    public function store(StoreProductRequest $request)
    {
        Product::create($request->only(['name', 'price']));

        return redirect('/products')->with('success', '商品を登録しました！');
    }

    /**
     * 商品詳細
     */
    public function show($productId)
    {
        $product = Product::findOrFail($productId);

        return view('products.show', compact('product'));
    }

    /**
     * 商品更新フォーム表示
     */
    public function edit($productId)
    {
        $product = Product::findOrFail($productId);

        return view('products.edit', compact('product'));
    }

    /**
     * 商品更新処理
     */
    public function update(UpdateProductRequest $request, $productId)
    {

    $product = Product::findOrFail($productId);

    $product->update($request->only(['name', 'price']));

    return redirect("/products/{$productId}")->with('success', '商品を更新しました！');
    }

    /**
     * 商品削除
     */
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);

        $product->delete();

        return redirect('/products')->with('success', '商品を削除しました！');
    }

    /**
     * 商品検索
     */
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $products = Product::query()
            ->when($keyword, function ($query, $keyword) {
                $query->where('name', 'LIKE', "%{$keyword}%");
            })
            ->get();

        return view('products.search', compact('products', 'keyword'));
    }
}
