<?php
namespace App\Infrastructure\Vat;

use Illuminate\Support\Facades\Http;
use App\Domain\Vat\Contracts\VatClientInterface;
use RuntimeException;

class VatComplyClient implements VatClientInterface
{
    public function getRate(): float
    {
        $response = Http::get('https://api.vatcomply.com/vat_rates?country_code=lv');

        if ($response->failed()) {
            throw new RuntimeException('VAT rate lookup failed: ' . $response->status());
        }

        $rate = $response->json('0.standard_rate');

        if ($rate === null) {
            throw new RuntimeException('VAT rate missing from response.');
        }

        return (float) $rate;
    }
}