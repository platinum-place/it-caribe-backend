<?php

namespace Modules\Quote\Submodules\Vehicle\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Common\Domain\Contracts\ZohoApiClientInterface;
use Modules\Quote\Submodules\Vehicle\Application\UseCases\EstimateQuoteUseCase;
use Modules\Quote\Submodules\Vehicle\Domain\Contracts\EstimateVehicleQuoteInterface;
use Modules\ZohoIntegration\Infrastructure\Http\ZohoApiClient;

class ContractServiceProvider extends ServiceProvider
{
    protected array $classes = [
        EstimateVehicleQuoteInterface::class => EstimateQuoteUseCase::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->classes as $interface => $class) {
            $this->app->bind($interface, $class);
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
