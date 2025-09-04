<?php

namespace Modules\Infrastructure\Insurances\Products\Humano\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Application\Insurances\Products\Humano\Contracts\EstimateVehicleHumanoInterface;
use Modules\Application\Insurances\Products\Humano\UseCases\EstimateZohoVehicleUseCase;

class AppServiceProvider extends ServiceProvider
{
    protected array $contracts = [
        EstimateVehicleHumanoInterface::class => EstimateZohoVehicleUseCase::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->contracts as $interface => $class) {
            $this->app->singleton($interface, $class);
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
