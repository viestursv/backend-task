<?php
namespace App\Domain\Product\Actions;

use App\Domain\Product\Models\Product;
use App\Domain\Vat\Services\VatService;
use Illuminate\Support\Str;

class CreateProductAction
{
    public function __construct(
        private VatService $vatService
    ) {}

    public function execute(array $data): Product
    {
        $data['slug'] = Str::slug($data['name']);
        $data['price'] = $this->vatService->apply($data['price_wo_vat']);

        return Product::create($data);
    }
}