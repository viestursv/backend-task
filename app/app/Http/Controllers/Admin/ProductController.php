<?php
namespace App\Http\Controllers\Admin;

use App\Domain\Product\Actions\CreateProductAction;
use App\Domain\Product\Actions\UpdateProductAction;
use App\Domain\Product\Actions\DeleteProductAction;
use App\Domain\Product\Models\Product;
use App\Http\Resources\Admin\ProductResource;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use Illuminate\Http\JsonResponse;

class ProductController
{
    public function __construct(
        private CreateProductAction $createAction,
        private UpdateProductAction $updateAction,
        private DeleteProductAction $deleteAction,
    ) {}

    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = $this->createAction->execute($request->validated());
        return ProductResource::make($product)->response()->setStatusCode(201);
    }

    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $product = $this->updateAction->execute($product, $request->validated());
        return ProductResource::make($product)->response();
    }

    public function destroy(Product $product): JsonResponse
    {
        $this->deleteAction->execute($product);
        return response()->json(null, 204);
    }
}