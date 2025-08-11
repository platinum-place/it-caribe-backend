<?php

namespace Modules\Vehicle;

use Illuminate\Support\ServiceProvider;
use Modules\Vehicle\Infrastructure\Providers\ContractServiceProvider;
use Modules\Vehicle\Infrastructure\Providers\MigrationServiceProvider;
use Modules\Vehicle\Infrastructure\Providers\PolicyServiceProvider;
use Modules\Vehicle\Presentation\Providers\FilamentPanelProvider;

class AppServiceProvider extends ServiceProvider
{
    protected array $providers = [
        ContractServiceProvider::class,
        MigrationServiceProvider::class,
        PolicyServiceProvider::class,
        FilamentPanelProvider::class,
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
