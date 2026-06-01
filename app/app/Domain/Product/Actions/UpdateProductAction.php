<?php
namespace App\Domain\Product\Actions;

use App\Domain\Product\Models\Product;
use App\Domain\Vat\Services\VatService;
use Illuminate\Support\Str;

class UpdateProductAction
{
    public function __construct(
        private VatService $vatService
    ) {}

    public function execute(Product $product, array $data): Product
    {
        if (isset($data['name'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        if (isset($data['price_wo_vat'])) {
            $data['price'] = $this->vatService->apply($data['price_wo_vat']);
        }

        $product->update($data);
        return $product->refresh();
    }
}