<?php

namespace Root\ZohoApi;

use Illuminate\Support\ServiceProvider;
use Root\ZohoApi\Domain\Contracts\ZohoCRMInterface;
use Root\ZohoApi\Infrastructure\Adapters\ZohoApiAdapter;

class AppServiceProvider extends ServiceProvider
{
    protected array $contracts = [
        ZohoCRMInterface::class => ZohoApiAdapter::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->contracts as $interface => $class) {
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
