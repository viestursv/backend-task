<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductSetController as AdminProductSetController;
use App\Http\Controllers\Public\ProductSetController as PublicProductSetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VatController;

Route::prefix('public')->group(function () {
    Route::get('/product-sets/{slug}', [PublicProductSetController::class, 'show']);
});

Route::prefix('admin')
    ->middleware('api.key')
    ->group(function () {

        Route::post('/product-sets', [AdminProductSetController::class, 'store']);
        Route::put('/product-sets/{productSet}', [AdminProductSetController::class, 'update']);

        Route::post('/products', [ProductController::class, 'store']);
        Route::put('/products/{product}', [ProductController::class, 'update']);
        Route::delete('/products/{product}', [ProductController::class, 'destroy']);

        Route::put('/vat-rate', [VatController::class, 'update']);
    });