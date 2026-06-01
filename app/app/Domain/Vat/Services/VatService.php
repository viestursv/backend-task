<?php
namespace App\Domain\Vat\Services;

use App\Domain\Vat\Contracts\VatClientInterface;
use App\Models\Setting;

class VatService
{
    public function __construct(
        private VatClientInterface $client
    ) {}

    public function getRate(): float
    {
        return (float) Setting::query()->where('key', 'vat_rate')->value('value');
    }

    public function apply(float $priceWoVat): float
    {
        return round($priceWoVat * (1 + $this->getRate() / 100), 2);
    }

    public function syncRateFromApi(): float
    {
        $rate = $this->client->getRate();
        Setting::updateOrCreate(
            ['key' => 'vat_rate'],
            ['value' => $rate]
        );
        return $rate;
    }
}