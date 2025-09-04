<?php

namespace Modules\Infrastructure\Insurances\Products\Monumental\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Application\Insurances\Products\Monumental\UseCases\EstimateZohoVehicleUseCase;
use Modules\Application\Insurances\Products\Monumental\Contracts\EstimateMonumentalVehicleInsuranceInterface;

class AppServiceProvider extends ServiceProvider
{
    protected array $contracts = [
        EstimateMonumentalVehicleInsuranceInterface::class => EstimateZohoVehicleUseCase::class,
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
