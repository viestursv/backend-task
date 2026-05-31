<?php

namespace App\Domain\Vat\Clients;

use Illuminate\Support\Facades\Http;
use App\Domain\Vat\Contracts\VatClientInterface;

class VatComplyClient implements VatClientInterface
{
    public function getRate(): float
    {
        $response = Http::get('https://api.vatcomply.com/vat_rates?country_code=lv');

        return (float) $response->json('rates.LV.standard_rate');
    }
}