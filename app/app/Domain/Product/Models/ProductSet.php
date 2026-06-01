<?php

namespace App\Domain\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domain\Product\Models\Product> $products
 * @property-read int|null $products_count
 * @mixin \Eloquent
 */

class ProductSet extends Model
{
    use HasUuids;

    protected $table = 'product_sets';

    protected $fillable = [
        'name',
        'slug',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function isPublished(): bool
    {
        if ($this->relationLoaded('products')) {
            return $this->products->contains('published', true);
        }

        return $this->products()->where('published', true)->exists();
    }
}