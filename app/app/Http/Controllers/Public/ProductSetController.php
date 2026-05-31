<?php

namespace App\Http\Controllers\Public;

use Illuminate\Http\Request;
use App\Domain\Product\Actions\CreateProductSetAction;
use App\Http\Resources\Public\ProductSetResource;
use App\Models\ProductSet;

class ProductSetController
{
    public function __construct(
        private CreateProductSetAction $action
    ) {}

    public function show(string $slug)
    {
        $set = ProductSet::where('slug', $slug)
            ->with(['products' => fn ($q) => $q->where('published', true)])
            ->firstOrFail();

        return new ProductSetResource($set);
    }
}