<?php

namespace Modules\Common\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Common\Domain\Contracts\ZohoApiClientInterface;
use Modules\Common\Infrastructure\Http\ZohoApiClient;

class ContractServiceProvider extends ServiceProvider
{
    protected array $classes = [
        ZohoApiClientInterface::class => ZohoApiClient::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->classes as $interface => $class) {
            $this->app->bind($interface, $class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
