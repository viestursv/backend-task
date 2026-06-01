<?php
namespace App\Domain\Product\Actions;

use App\Domain\Product\Models\Product;
use Illuminate\Validation\ValidationException;

class DeleteProductAction
{
    public function execute(Product $product): void
    {
        $set = $product->productSet;

        if ($set->products()->count() === 1) {
            throw ValidationException::withMessages([
                'product' => 'Cannot delete the last product in a set.'
            ]);
        }

        $product->delete();
    }
}