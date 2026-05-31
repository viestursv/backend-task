<?php

namespace App\Providers;

use App\Domain\Vat\Clients\VatComplyClient;
use App\Domain\Vat\Contracts\VatClientInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            VatClientInterface::class,
            VatComplyClient::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
