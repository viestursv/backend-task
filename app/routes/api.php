<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\ProductSetController as PublicProductSet;
use App\Http\Controllers\Admin\ProductSetController as AdminProductSet;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VatController;

Route::prefix('public')->group(function () {
    Route::get('/product-sets', [PublicProductSet::class, 'index']);
    Route::get('/product-sets/{slug}', [PublicProductSet::class, 'show']);
});

Route::prefix('admin')
    // ->middleware('api.key')
    ->group(function () {

        Route::post('/product-sets', [AdminProductSet::class, 'store']);
        Route::put('/product-sets/{id}', [AdminProductSet::class, 'update']);

        Route::post('/products', [ProductController::class, 'store']);
        Route::put('/products/{id}', [ProductController::class, 'update']);
        Route::delete('/products/{id}', [ProductController::class, 'destroy']);

        // Route::put('/vat', [VatController::class, 'update']);
    });