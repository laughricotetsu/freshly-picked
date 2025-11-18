<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);          // 一覧
    Route::get('/register', [ProductController::class, 'create']); // 登録フォーム
    Route::post('/register', [ProductController::class, 'store']); // 登録処理

    Route::get('/search', [ProductController::class, 'search']);   // 検索

    Route::get('/{productId}', [ProductController::class, 'show']);        // 詳細
    Route::get('/{productId}/update', [ProductController::class, 'edit']); // 更新フォーム
    Route::post('/{productId}/update', [ProductController::class, 'update']); // 更新処理

    Route::delete('/{productId}/delete', [ProductController::class, 'destroy']); // 削除
});
