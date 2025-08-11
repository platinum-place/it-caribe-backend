<?php

namespace Modules\Quote\Submodules\Vehicle;

use Illuminate\Support\ServiceProvider;
use Modules\Quote\Submodules\Vehicle\Infrastructure\Providers\ContractServiceProvider;
use Modules\Quote\Submodules\Vehicle\Infrastructure\Providers\MigrationServiceProvider;
use Modules\Quote\Submodules\Vehicle\Infrastructure\Providers\PolicyServiceProvider;
use Modules\Quote\Submodules\Vehicle\Presentation\Providers\FilamentPanelProvider;

class AppServiceProvider extends ServiceProvider
{
    protected array $providers = [
        MigrationServiceProvider::class,
        ContractServiceProvider::class,
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
