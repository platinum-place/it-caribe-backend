<?php

namespace Modules\Common;

use Illuminate\Support\ServiceProvider;
use Modules\Common\Infrastructure\Providers\ContractServiceProvider;
use Modules\Common\Infrastructure\Providers\MigrationServiceProvider;
use Modules\Common\Presentation\Providers\AdminPanelProvider;

class AppServiceProvider extends ServiceProvider
{
    protected array $providers = [
        ContractServiceProvider::class,
        MigrationServiceProvider::class,
        AdminPanelProvider::class,
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
