<?php

namespace App\Http\Controllers\Public;

use App\Domain\Product\Models\ProductSet;
use App\Http\Resources\Public\ProductSetResource;
use Illuminate\Http\JsonResponse;

class ProductSetController
{
    public function show(string $slug): JsonResponse
    {
        $set = ProductSet::where('slug', $slug)
            ->whereHas('products', fn ($q) => $q->where('published', true))
            ->with(['products' => fn ($q) => $q->where('published', true)])
            ->firstOrFail();

        return ProductSetResource::make($set)->response();
    }
}