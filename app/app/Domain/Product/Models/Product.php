<?php

namespace App\Domain\Product\Models;

use App\Domain\Product\Enums\ProductCondition;
use App\Domain\Product\Enums\ProductType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $id
 * @property string $product_set_id
 * @property string $sku
 * @property string $name
 * @property string $slug
 * @property string $type
 * @property string $condition
 * @property string $description_title
 * @property string $description_text
 * @property numeric $price
 * @property numeric $price_wo_vat
 * @property numeric $wholesale_price
 * @property bool $published
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Domain\Product\Models\ProductSet $productSet
 * @mixin \Eloquent
 */

class Product extends Model
{
    use HasUuids;

    protected $table = 'products';

    protected $casts = [
        'type' => ProductType::class,
        'condition' => ProductCondition::class,
        'published' => 'boolean',
    ];

    protected $fillable = [
        'product_set_id',
        'sku',
        'name',
        'slug',
        'type',
        'condition',
        'description_title',
        'description_text',
        'price_wo_vat',
        'price',
        'wholesale_price',
        'published',
    ];

    public function productSet(): BelongsTo
    {
        return $this->belongsTo(ProductSet::class);
    }
}