<?php

namespace App\Providers;

use App\Contracts\Services\UserServiceContract;
use App\Contracts\Services\VehicleMakeServiceContract;
use App\Contracts\Services\VehicleModelServiceContract;
use App\Contracts\Services\VehicleTypeServiceContract;
use App\Contracts\Services\VendorServiceContract;
use App\Contracts\Services\ZohoAPIServiceContract;
use App\Contracts\Services\ZohoOauthAccessTokenServiceContract;
use App\Contracts\Services\ZohoOauthRefreshTokenServiceContract;
use App\Contracts\Services\ZohoServiceContract;
use App\Services\UserService;
use App\Services\VehicleMakeService;
use App\Services\VehicleModelService;
use App\Services\VehicleTypeService;
use App\Services\VendorService;
use App\Services\ZohoAPIServiceService;
use App\Services\ZohoOauthAccessTokenService;
use App\Services\ZohoOauthRefreshTokenService;
use App\Services\ZohoService;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    protected array $services = [
        UserServiceContract::class => UserService::class,
        VendorServiceContract::class => VendorService::class,
        VehicleMakeServiceContract::class => VehicleMakeService::class,
        VehicleTypeServiceContract::class => VehicleTypeService::class,
        VehicleModelServiceContract::class => VehicleModelService::class,
        ZohoOauthAccessTokenServiceContract::class => ZohoOauthAccessTokenService::class,
        ZohoOauthRefreshTokenServiceContract::class => ZohoOauthRefreshTokenService::class,
        ZohoServiceContract::class => ZohoService::class,
        ZohoAPIServiceContract::class => ZohoAPIServiceService::class,
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
