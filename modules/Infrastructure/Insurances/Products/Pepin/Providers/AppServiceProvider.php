<?php

namespace Modules\Infrastructure\Insurances\Products\Pepin\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Application\Insurances\Products\Pepin\Contracts\EstimateVehiclePepinInterface;
use Modules\Application\Insurances\Products\Pepin\UseCases\EstimateZohoVehicleUseCase;

class AppServiceProvider extends ServiceProvider
{
    protected array $contracts = [
        EstimateVehiclePepinInterface::class => EstimateZohoVehicleUseCase::class,
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
