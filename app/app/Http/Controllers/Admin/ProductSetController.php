<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Domain\Product\Actions\CreateProductSetAction;

class ProductSetController
{
    public function __construct(
        private CreateProductSetAction $action
    ) {}

    public function store(Request $request)
    {
        $set = $this->action->execute(
            $request->only(['name']),
            $request->input('products')
        );

        return response()->json($set, 201);
    }
}