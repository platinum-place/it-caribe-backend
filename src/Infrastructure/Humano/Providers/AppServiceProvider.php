<?php

namespace Modules\Infrastructure\Humano\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Application\Humano\Contracts\EstimateHumanoVehicleInsuranceInterface;
use Modules\Application\Humano\UseCases\EstimateZohoVehicleUseCase;

class AppServiceProvider extends ServiceProvider
{
    protected array $contracts = [
        EstimateHumanoVehicleInsuranceInterface::class => EstimateZohoVehicleUseCase::class,
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
