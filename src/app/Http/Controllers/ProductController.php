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
    $query = Product::query();

    // --- 検索 ---
    if ($request->filled('keyword')) {
        $query->where('name', 'like', '%' . $request->keyword . '%');
    }

    // --- 並び替え ---
    if ($request->filled('sort')) {

        // 高い順
        if ($request->sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        }

        // 低い順
        if ($request->sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        }
    }

    $products = $query->paginate(6)->appends($request->query());

    return view('products.index', compact('products'));
}

    /**
     * 商品登録フォーム表示
     */
    public function create()
    {
        $seasons = Season::all();
        return view('products.create',compact('seasons'));
    }

    /**
     * 商品登録処理
     */
    public function store(StoreProductRequest $request)
    {
        $form = $request->all();
        StoreProduct::create($form);
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
        Product::findOrFail($productId)->delete();

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
