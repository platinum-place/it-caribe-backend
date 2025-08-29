<?php

namespace App\Providers;

use app\Adapters\ZohoApiAdapter;
use App\Contracts\ZohoCRMInterface;
use Illuminate\Support\ServiceProvider;

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
        foreach ($this->contracts as $interface => $provider) {
            $this->app->bind($interface, $provider);
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
