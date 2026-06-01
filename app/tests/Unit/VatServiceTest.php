<?php
namespace Tests\Unit;

use App\Domain\Vat\Contracts\VatClientInterface;
use App\Domain\Vat\Services\VatService;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class VatServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_apply_calculates_price_with_vat(): void
    {
        Setting::create(['key' => 'vat_rate', 'value' => '21.00']);

        $client = Mockery::mock(VatClientInterface::class);
        $service = new VatService($client);

        $result = $service->apply(100.00);

        $this->assertEquals(121.00, $result);
    }

    public function test_apply_rounds_to_two_decimal_places(): void
    {
        Setting::create(['key' => 'vat_rate', 'value' => '21.00']);

        $client = Mockery::mock(VatClientInterface::class);
        $service = new VatService($client);

        $result = $service->apply(99.99);

        $this->assertEquals(120.99, $result);
    }

    public function test_sync_rate_saves_to_database(): void
    {
        Setting::create(['key' => 'vat_rate', 'value' => '21.00']);

        $client = Mockery::mock(VatClientInterface::class);
        $client->shouldReceive('getRate')->once()->andReturn(23.0);

        $service = new VatService($client);
        $rate = $service->syncRateFromApi();

        $this->assertEquals(23.0, $rate);
        $this->assertDatabaseHas('settings', [
            'key'   => 'vat_rate',
            'value' => '23',
        ]);
    }
}