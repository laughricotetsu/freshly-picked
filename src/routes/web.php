<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])
        ->name('products.index');    // 一覧
    Route::get('/create', [ProductController::class, 'create'])
        ->name('products.create');
    Route::post('/create', [ProductController::class, 'store'])
        ->name('products.store');
    Route::get('/search', [ProductController::class, 'search'])
        ->name('products.search');


    Route::get('/register', [ProductController::class, 'create']); // 登録フォーム
    Route::post('/register', [ProductController::class, 'store']); // 登録処理
    Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show'); // 詳細
    Route::get('/{productId}/update', [ProductController::class, 'edit']); // 更新フォーム
    Route::post('/{productId}/update', [ProductController::class, 'update']); // 更新処理
    Route::delete('/{productId}/delete', [ProductController::class, 'destroy']); // 削除
});
