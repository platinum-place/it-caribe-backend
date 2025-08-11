<?php

namespace Modules\Quote;

use Illuminate\Support\ServiceProvider;
use Modules\Quote\Infrastructure\Providers\ContractServiceProvider;
use Modules\Quote\Infrastructure\Providers\MigrationServiceProvider;
use Modules\Quote\Presentation\Providers\FilamentPanelProvider;
use Modules\Quote\Submodules\Vehicle\AppServiceProvider as VehicleAppServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected array $providers = [
        MigrationServiceProvider::class,
        FilamentPanelProvider::class,
        ContractServiceProvider::class,
        VehicleAppServiceProvider::class
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
