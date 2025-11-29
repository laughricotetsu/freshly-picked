<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

    Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])
        ->name('products.index'); // 一覧

   Route::get('/create', [ProductController::class, 'create'])->name('products.create'); // 登録フォーム
    Route::post('/create', [ProductController::class, 'store'])->name('products.store'); // 登録処理

    Route::get('/search', [ProductController::class, 'search'])
        ->name('products.search'); //検索

    Route::get('/{product}', [ProductController::class, 'show'])
        ->name('products.show'); // 詳細

    Route::delete('/{id}/delete', [ProductController::class, 'destroy'])
    ->name('products.delete');


    Route::get('/{id}/update', [ProductController::class, 'edit'])
    ->name('products.edit'); // 更新フォーム


    Route::put('/{id}/update', [ProductController::class, 'update'])
    ->name('products.update'); // 更新処理

});
