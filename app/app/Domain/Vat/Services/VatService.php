<?php 

namespace App\Domain\Vat\Services;

use App\Domain\Vat\Contracts\VatClientInterface;

class VatService
{
    public function __construct(
        private VatClientInterface $client
    ) {}

    public function apply(float $priceWoVat): float
    {
        $rate = $this->client->getRate();

        return round(
            $priceWoVat * (1 + $rate / 100),
            2
        );
    }
}