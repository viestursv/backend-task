<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Product\Actions\CreateProductSetAction;
use App\Domain\Product\Actions\UpdateProductSetAction;
use App\Domain\Product\Models\ProductSet;
use App\Http\Resources\Admin\ProductSetResource;
use App\Http\Requests\Admin\StoreProductSetRequest;
use App\Http\Requests\Admin\UpdateProductSetRequest;
use Illuminate\Http\JsonResponse;

class ProductSetController
{
    public function __construct(
        private CreateProductSetAction $createAction,
        private UpdateProductSetAction $updateAction,
    ) {}

    public function store(StoreProductSetRequest $request): JsonResponse
    {
        $set = $this->createAction->execute($request->validated());
        return ProductSetResource::make($set)->response()->setStatusCode(201);
    }

    public function update(UpdateProductSetRequest $request, ProductSet $productSet): JsonResponse
    {
        $set = $this->updateAction->execute($productSet, $request->validated());
        return ProductSetResource::make($set)->response();
    }
}