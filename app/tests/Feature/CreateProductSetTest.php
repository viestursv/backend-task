<?php
namespace Tests\Feature;

use App\Domain\Product\Models\Product;
use App\Domain\Product\Models\ProductSet;
use App\Domain\Vat\Contracts\VatClientInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateProductSetTest extends TestCase
{
    use RefreshDatabase;

    private string $apiKey = 'test-api-key';

    protected function setUp(): void
    {
        parent::setUp();

        config(['app.api_key' => $this->apiKey]);

        // Mock VAT client
        $this->mock(VatClientInterface::class, function ($mock) {
            $mock->shouldReceive('getRate')->andReturn(21.0);
        });

        \App\Models\Setting::create(['key' => 'vat_rate', 'value' => '21.00']);
    }

    public function test_admin_can_create_product_set(): void
    {
        $response = $this->postJson('/api/admin/product-sets', [
            'name'     => 'Test Set',
            'products' => [
            [
                'sku'               => 'TEST-001',
                'name'              => 'Test Product',
                'type'              => 'service',
                'condition'         => 'new',
                'description_title' => 'Test title',
                'description_text'  => 'Test description text.',
                'price_wo_vat'      => 100.00,
                'wholesale_price'   => 80.00,
                'published'         => true,
            ],
        ],
        ], ['X-API-KEY' => $this->apiKey]);

        $response->assertStatus(201)
            ->assertJsonPath('data.name', 'Test Set')
            ->assertJsonPath('data.slug', 'test-set');

        $this->assertDatabaseHas('product_sets', ['name' => 'Test Set']);
        $this->assertDatabaseHas('products', [
            'sku'   => 'TEST-001',
            'price' => 121.00,
        ]);
    }

    public function test_create_product_set_requires_api_key(): void
    {
        $response = $this->postJson('/api/admin/product-sets', [
            'name'     => 'Test Set',
            'products' => [
                'sku'               => 'TEST-001',
                'name'              => 'Test Product',
                'type'              => 'device',
                'condition'         => 'new',
                'description_title' => 'Test title',
                'description_text'  => 'Test description text.',
                'price_wo_vat'      => 100.00,
                'wholesale_price'   => 80.00,
                'published'         => true,
            ],
        ]);

        $response->assertStatus(401);
    }

    public function test_create_product_set_requires_at_least_one_product(): void
    {
        $response = $this->postJson('/api/admin/product-sets', [
            'name'     => 'Test Set',
            'products' => [],
        ], ['X-API-KEY' => $this->apiKey]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['products']);
    }

    public function test_cannot_delete_last_product_in_set(): void
    {
        $set = ProductSet::factory()->create();
        $product = Product::factory()->create(['product_set_id' => $set->id]);

        $response = $this->deleteJson(
            "/api/admin/products/{$product->id}",
            [],
            ['X-API-KEY' => $this->apiKey]
        );

        $response->assertStatus(422);
        $this->assertDatabaseHas('products', ['id' => $product->id]);
    }
}