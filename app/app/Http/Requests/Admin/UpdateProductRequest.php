<?php
namespace App\Http\Requests\Admin;

use App\Domain\Product\Enums\ProductCondition;
use App\Domain\Product\Enums\ProductType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'sku'               => ['sometimes', 'string', Rule::unique('products', 'sku')->ignore($this->product)],
            'name'              => ['sometimes', 'string', 'max:50'],
            'type'              => ['sometimes', Rule::enum(ProductType::class)],
            'condition'         => ['sometimes', Rule::enum(ProductCondition::class)],
            'description_title' => ['sometimes', 'nullable', 'string', 'max:255'],
            'description_text'  => ['sometimes', 'nullable', 'string', 'max:255'],
            'price_wo_vat'      => ['sometimes', 'numeric', 'min:0'],
            'wholesale_price'   => ['sometimes', 'nullable', 'numeric', 'min:0'],
            'published'         => ['sometimes', 'boolean'],
        ];
    }
}