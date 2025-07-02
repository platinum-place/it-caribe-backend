<?php

namespace App\Providers;

use App\Contracts\Services\Partners\VendorServiceContract;
use App\Contracts\Services\UserServiceContract;
use App\Services\Partner\VendorService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    protected array $services = [
        UserServiceContract::class => UserService::class,
        VendorServiceContract::class => VendorService::class,
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
