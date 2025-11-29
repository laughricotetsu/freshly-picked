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
    // 画像を保存
    $imageName = null;
    if ($request->hasFile('image')) {
        $imageName = $request->file('image')->store('img', 'public');
    }
    // 商品を登録
    $product = Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'description' => $request->description,
        'image' => $imageName,
    ]);

    // 季節（中間テーブルへ保存）
    if ($request->has('season_id')) {
        $product->seasons()->sync($request->season_id);
    }

    return redirect()->route('products.index');
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
    public function edit($id)
{
    $product = Product::findOrFail($id);
    $seasons = Season::all();

    return view('products.edit', compact('product', 'seasons'));
}

    /**
     * 商品更新処理
     */
    public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    // 商品情報更新
    $product->name = $request->name;
    $product->price = $request->price;
    $product->description = $request->description ?? $product->description;
    $product->save();

    // 季節の更新（中間テーブル）
    if ($request->has('season_id')) {
        // 選択された季節に置き換える
        $product->seasons()->sync($request->season_id);
    } else {
        // 何も選択されなかった場合 → 全解除
        $product->seasons()->sync([]);
    }

    return redirect()->route('products.show', $product->id);
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
