<?php

namespace App\Providers;

use App\Contracts\Repositories\ProductTypeRepositoryContract;
use App\Contracts\Repositories\UserRepositoryContract;
use App\Contracts\Repositories\VehicleMakeRepositoryContract;
use App\Contracts\Repositories\VehicleModelRepositoryContract;
use App\Contracts\Repositories\VehicleTypeRepositoryContract;
use App\Contracts\Repositories\VendorRepositoryContract;
use App\Contracts\Repositories\ZohoOauthAccessTokenRepositoryContract;
use App\Contracts\Repositories\ZohoOauthRefreshTokenRepositoryContract;
use App\Repositories\ProductTypeRepository;
use App\Repositories\UserRepository;
use App\Repositories\VehicleMakeRepository;
use App\Repositories\VehicleModelRepository;
use App\Repositories\VehicleTypeRepository;
use App\Repositories\VendorRepository;
use App\Repositories\ZohoOauthAccessTokenRepository;
use App\Repositories\ZohoOauthRefreshTokenRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected array $repositories = [
        UserRepositoryContract::class => UserRepository::class,
        VendorRepositoryContract::class => VendorRepository::class,
        VehicleMakeRepositoryContract::class => VehicleMakeRepository::class,
        VehicleTypeRepositoryContract::class => VehicleTypeRepository::class,
        VehicleModelRepositoryContract::class => VehicleModelRepository::class,
        ZohoOauthAccessTokenRepositoryContract::class => ZohoOauthAccessTokenRepository::class,
        ZohoOauthRefreshTokenRepositoryContract::class => ZohoOauthRefreshTokenRepository::class,
        ProductTypeRepositoryContract::class => ProductTypeRepository::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        foreach ($this->repositories as $interface => $implementation) {
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
