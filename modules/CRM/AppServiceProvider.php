<?php

namespace Modules\CRM;

use Illuminate\Support\ServiceProvider;
use Modules\CRM\Infrastructure\Providers\ContractServiceProvider;
use Modules\CRM\Infrastructure\Providers\MigrationServiceProvider;
use Modules\CRM\Infrastructure\Providers\PolicyServiceProvider;
use Modules\CRM\Presentation\Providers\FilamentPanelProvider;

class AppServiceProvider extends ServiceProvider
{
    protected array $providers = [
        MigrationServiceProvider::class,
        FilamentPanelProvider::class,
        ContractServiceProvider::class,
        PolicyServiceProvider::class,
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
