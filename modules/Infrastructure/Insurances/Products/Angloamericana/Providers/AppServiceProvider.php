<?php

namespace Modules\Infrastructure\Insurances\Products\Angloamericana\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Application\Insurances\Products\Angloamericana\Contracts\EstimateVehicleAngloamericanaInterface;
use Modules\Application\Insurances\Products\Monumental\Contracts\EstimateVehicleMonumentalInterface;
use Modules\Application\Insurances\Products\Sura\Contracts\EstimateVehicleSuraInterface;
use Modules\Application\Insurances\Products\Angloamericana\UseCases\EstimateZohoVehicleUseCase;

class AppServiceProvider extends ServiceProvider
{
    protected array $contracts = [
        EstimateVehicleAngloamericanaInterface::class => EstimateZohoVehicleUseCase::class,
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
