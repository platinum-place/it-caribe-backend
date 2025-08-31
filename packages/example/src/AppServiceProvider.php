<?php

namespace Root\Example;

use Illuminate\Support\ServiceProvider;
use Root\Example\Domain\Contracts\ZohoCRMInterface;
use Root\Example\Domain\Contracts\ZohoOauthAccessTokenRepositoryInterface;
use Root\Example\Domain\Contracts\ZohoOauthClientRepositoryInterface;
use Root\Example\Domain\Contracts\ZohoOauthRefreshTokenRepositoryInterface;
use Root\Example\Infrastructure\Adapters\ExampleAdapter;
use Root\Example\Infrastructure\Persistence\Repositories\ZohoOauthAccessTokenEloquentRepository;
use Root\Example\Infrastructure\Persistence\Repositories\ZohoOauthClientEloquentRepository;
use Root\Example\Infrastructure\Persistence\Repositories\ZohoOauthRefreshTokenEloquentRepository;

class AppServiceProvider extends ServiceProvider
{
    protected array $contracts = [
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->contracts as $interface => $class) {
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
