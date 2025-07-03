<?php

namespace App\Providers;

use App\Contracts\Services\Partners\VendorServiceContract;
use App\Contracts\Services\UserServiceContract;
use App\Contracts\Services\Vehicle\VehicleMakeServiceContract;
use App\Contracts\Services\Vehicle\VehicleModelServiceContract;
use App\Contracts\Services\Vehicle\VehicleTypeServiceContract;
use App\Services\Partners\VendorService;
use App\Services\UserService;
use App\Services\Vehicle\VehicleMakeService;
use App\Services\Vehicle\VehicleModelService;
use App\Services\Vehicle\VehicleTypeService;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    protected array $services = [
        UserServiceContract::class => UserService::class,
        VendorServiceContract::class => VendorService::class,
        VehicleMakeServiceContract::class => VehicleMakeService::class,
        VehicleTypeServiceContract::class => VehicleTypeService::class,
        VehicleModelServiceContract::class => VehicleModelService::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        foreach ($this->services as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
