<?php

namespace Modules\Quote;

use Illuminate\Support\ServiceProvider;
use Modules\Quote\Infrastructure\Providers\ContractServiceProvider;
use Modules\Quote\Infrastructure\Providers\MigrationServiceProvider;
use Modules\Quote\Infrastructure\Providers\PolicyServiceProvider;
use Modules\Quote\Presentation\Providers\QuotePanelProvider;
use Modules\Quote\Vehicle\AppServiceProvider as VehicleAppServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected array $providers = [
        MigrationServiceProvider::class,
        QuotePanelProvider::class,
        ContractServiceProvider::class,
        PolicyServiceProvider::class,
        VehicleAppServiceProvider::class,
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
