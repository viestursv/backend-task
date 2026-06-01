<?php

namespace App\Http\Requests\Admin;

use App\Domain\Product\Enums\ProductCondition;
use App\Domain\Product\Enums\ProductType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductSetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'                          => ['required', 'string', 'max:70'],
            'products'                      => ['required', 'array', 'min:1'],
            'products.*.sku'                => ['required', 'string', 'unique:products,sku'],
            'products.*.name'               => ['required', 'string', 'max:50'],
            'products.*.description_title'  => ['required', 'string', 'max:255'],
            'products.*.description_text'   => ['required', 'string', 'max:255'],
            'products.*.type'               => ['required', Rule::enum(ProductType::class)],
            'products.*.condition'          => ['required', Rule::enum(ProductCondition::class)],
            'products.*.price_wo_vat'       => ['required', 'numeric', 'min:0'],
            'products.*.wholesale_price'    => ['required', 'numeric', 'min:0'],
            'products.*.published'          => ['boolean'],
        ];
    }
}