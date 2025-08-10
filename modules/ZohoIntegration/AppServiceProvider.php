<?php

namespace Modules\ZohoIntegration;

use Illuminate\Support\ServiceProvider;
use Modules\ZohoIntegration\Infrastructure\Providers\ContractServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected array $providers = [
        ContractServiceProvider::class,
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
