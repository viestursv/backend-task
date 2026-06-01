<?php

namespace App\Domain\Product\Actions;

use App\Domain\Product\Models\ProductSet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Domain\Vat\Services\VatService;

class CreateProductSetAction
{
    public function __construct(
        private VatService $vatService
    ) {}

    public function execute(array $data): ProductSet
    {
        return DB::transaction(function () use ($data) {
            $set = ProductSet::create([
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
            ]);

            // Create products and add them to the set
            foreach ($data['products'] as $product) {
                $product['price'] = $this->vatService->apply(
                    $product['price_wo_vat']
                );

                $product['slug'] = Str::slug($product['name']);

                $set->products()->create($product);
            }

            return $set;
        });
    }
}