<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])
        ->name('products.index'); // 一覧

    Route::get('/create', [ProductController::class, 'create'])
        ->name('products.create'); // 登録フォーム

    Route::post('/', [ProductController::class, 'store'])
        ->name('products.store'); // 登録処理

    Route::get('/search', [ProductController::class, 'search'])
        ->name('products.search'); //検索

    Route::get('/{product}', [ProductController::class, 'show'])
        ->name('products.show'); // 詳細

    Route::get('/{product}/update', [ProductController::class, 'edit'])
        ->name('products.edit'); // 更新フォーム

    Route::post('/{product}/update', [ProductController::class, 'update'])
        ->name('products.update'); // 更新処理

    Route::delete('/{product}/delete', [ProductController::class, 'destroy'])
        ->name('products.destroy'); // 削除
});
