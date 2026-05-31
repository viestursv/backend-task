<?php

namespace App\Domain\Product\Enums;

enum ProductType: string
{
    case DEVICE = 'device';
    case SERVICE = 'service';
}