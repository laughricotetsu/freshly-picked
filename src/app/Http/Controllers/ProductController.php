<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Season;


class ProductController extends Controller
{
    /**
     * 商品一覧
     */
    public function index(Request $request)
    {
        $products = Product::paginate(6);

        $query = Product::query();

        // 検索
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // 価格順
        if ($request->order === 'low') {
            $query->orderBy('price', 'asc');
        } elseif ($request->order === 'high') {
            $query->orderBy('price', 'desc');
        }

        return view('products.index', compact('products'));
    }

    /**
     * 商品登録フォーム表示
     */
    public function register()
    {
        return view('products.register');
    }

    /**
     * 商品登録処理
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        // 画像保存
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }

        $product->save();

        return redirect('/products')->with('success', '商品を登録しました！');
    }

    /**
     * 商品詳細
     */
    public function show(Product $product)
    {
        $seasons = Season::all();
        return view('products.show', compact('product','seasons'));
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
