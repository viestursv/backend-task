<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @mixin \Eloquent
 */

class ProductSet extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function isPublished(): bool
    {
        return $this->products()->where('published', true)->exists();
    }
}