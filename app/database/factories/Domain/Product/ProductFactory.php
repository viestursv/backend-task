<?php
namespace Database\Factories\Domain\Product;

use App\Domain\Product\Enums\ProductCondition;
use App\Domain\Product\Enums\ProductType;
use App\Domain\Product\Models\Product;
use App\Domain\Product\Models\ProductSet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);
        return [
            'product_set_id'    => ProductSet::factory(),
            'sku'               => strtoupper(Str::random(8)),
            'name'              => $name,
            'slug'              => Str::slug($name),
            'type'              => $this->faker->randomElement(ProductType::cases()),
            'condition'         => $this->faker->randomElement(ProductCondition::cases()),
            'description_title' => $this->faker->sentence(),
            'description_text'  => $this->faker->paragraph(),
            'price_wo_vat'      => $this->faker->randomFloat(2, 10, 1000),
            'price'             => $this->faker->randomFloat(2, 12, 1210),
            'wholesale_price'   => $this->faker->randomFloat(2, 5, 500),
            'published'         => true,
        ];
    }
}