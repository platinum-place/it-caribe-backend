<?php

namespace App\Providers;

use App\Contracts\Repositories\Partners\VendorRepositoryContract;
use App\Contracts\Repositories\UserRepositoryContract;
use App\Repositories\Partner\VendorRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected array $repositories = [
        UserRepositoryContract::class => UserRepository::class,
        VendorRepositoryContract::class => VendorRepository::class,
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
