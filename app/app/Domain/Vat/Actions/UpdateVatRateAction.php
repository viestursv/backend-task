<?php
namespace App\Domain\Vat\Actions;

use App\Domain\Product\Models\Product;
use App\Domain\Vat\Services\VatService;
use Illuminate\Support\Facades\DB;

class UpdateVatRateAction
{
    public function __construct(
        private VatService $vatService
    ) {}

    public function execute(): void
    {
        DB::transaction(function () {
            $rate = $this->vatService->syncRateFromApi();

            Product::query()->each(function (Product $product) use ($rate) {
                $product->update([
                    'price' => round($product->price_wo_vat * (1 + $rate / 100), 2)
                ]);
            });
        });
    }
}