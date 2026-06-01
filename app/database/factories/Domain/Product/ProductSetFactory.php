<?php
namespace Database\Factories\Domain\Product;

use App\Domain\Product\Models\ProductSet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductSetFactory extends Factory
{
    protected $model = ProductSet::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}