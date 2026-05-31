<?php

namespace App\Domain\Vat\Contracts;

interface VatClientInterface
{
    public function getRate(): float;
}