<?php
namespace App\Http\Requests\Admin;

use App\Domain\Product\Enums\ProductCondition;
use App\Domain\Product\Enums\ProductType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_set_id'    => ['required', 'string', Rule::exists('product_sets', 'id')],
            'sku'               => ['required', 'string', 'unique:products,sku'],
            'name'              => ['required', 'string', 'max:50'],
            'type'              => ['required', Rule::enum(ProductType::class)],
            'condition'         => ['required', Rule::enum(ProductCondition::class)],
            'description_title' => ['nullable', 'string', 'max:255'],
            'description_text'  => ['nullable', 'string', 'max:255'],
            'price_wo_vat'      => ['required', 'numeric', 'min:0'],
            'wholesale_price'   => ['nullable', 'numeric', 'min:0'],
            'published'         => ['boolean'],
        ];
    }
}