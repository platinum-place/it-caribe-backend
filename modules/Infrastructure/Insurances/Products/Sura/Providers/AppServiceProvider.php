<?php

namespace Modules\Infrastructure\Insurances\Products\Sura\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Application\Insurances\Products\Monumental\Contracts\EstimateVehicleMonumentalInterface;
use Modules\Application\Insurances\Products\Sura\Contracts\EstimateVehicleSuraInterface;
use Modules\Application\Insurances\Products\Sura\UseCases\EstimateZohoVehicleUseCase;

class AppServiceProvider extends ServiceProvider
{
    protected array $contracts = [
        EstimateVehicleSuraInterface::class => EstimateZohoVehicleUseCase::class,
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
