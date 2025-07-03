<?php

namespace App\Providers;

use App\Contracts\Repositories\Partners\VendorRepositoryContract;
use App\Contracts\Repositories\UserRepositoryContract;
use App\Contracts\Repositories\Vehicle\VehicleMakeRepositoryContract;
use App\Repositories\Partners\VendorRepository;
use App\Repositories\UserRepository;
use App\Repositories\Vehicle\VehicleMakeRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected array $repositories = [
        UserRepositoryContract::class => UserRepository::class,
        VendorRepositoryContract::class => VendorRepository::class,
        VehicleMakeRepositoryContract::class => VehicleMakeRepository::class,
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
