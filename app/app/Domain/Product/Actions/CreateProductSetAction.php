<?php

namespace App\Domain\Product\Actions;

use App\Models\ProductSet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Domain\Vat\Services\VatService;

class CreateProductSetAction
{
    public function __construct(
        private VatService $vatService
    ) {}

    public function execute(array $setData, array $products): ProductSet
    {
        if (count($products) === 0) {
            throw new \InvalidArgumentException(
                'ProductSet must contain at least one product.'
            );
        }

        return DB::transaction(function () use ($setData, $products) {

            $setData['slug'] = Str::slug($setData['name']);
            $set = ProductSet::create($setData);

            // Create products and add them to the set
            foreach ($products as $product) {

                $product['price'] = $this->vatService->apply(
                    $product['price_wo_vat']
                );

                $product['slug'] = Str::slug($setData['name']);

                $set->products()->create($product);
            }

            return $set;
        });
    }
}