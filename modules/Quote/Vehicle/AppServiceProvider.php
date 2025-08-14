<?php

namespace Modules\Quote\Vehicle;

use Illuminate\Support\ServiceProvider;
use Modules\Quote\Vehicle\Infrastructure\Providers\ContractServiceProvider;
use Modules\Quote\Vehicle\Infrastructure\Providers\MigrationServiceProvider;
use Modules\Quote\Vehicle\Infrastructure\Providers\PolicyServiceProvider;
use Modules\Quote\Vehicle\Presentation\Providers\VehicleQuotePanelProvider;

class AppServiceProvider extends ServiceProvider
{
    protected array $providers = [
        MigrationServiceProvider::class,
        ContractServiceProvider::class,
        PolicyServiceProvider::class,
        VehicleQuotePanelProvider::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->providers as $class) {
            $this->app->register($class);
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
