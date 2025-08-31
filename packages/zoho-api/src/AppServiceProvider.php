<?php

namespace Root\ZohoApi;

use Illuminate\Support\ServiceProvider;
use Root\ZohoApi\Domain\Contracts\ZohoCRMInterface;
use Root\ZohoApi\Domain\Contracts\ZohoOauthAccessTokenRepositoryInterface;
use Root\ZohoApi\Domain\Contracts\ZohoOauthClientRepositoryInterface;
use Root\ZohoApi\Domain\Contracts\ZohoOauthRefreshTokenRepositoryInterface;
use Root\ZohoApi\Infrastructure\Adapters\ZohoApiAdapter;
use Root\ZohoApi\Infrastructure\Persistence\Repositories\ZohoOauthAccessTokenEloquentRepository;
use Root\ZohoApi\Infrastructure\Persistence\Repositories\ZohoOauthClientEloquentRepository;
use Root\ZohoApi\Infrastructure\Persistence\Repositories\ZohoOauthRefreshTokenEloquentRepository;

class AppServiceProvider extends ServiceProvider
{
    protected array $contracts = [
        ZohoCRMInterface::class => ZohoApiAdapter::class,
        ZohoOauthClientRepositoryInterface::class => ZohoOauthClientEloquentRepository::class,
        ZohoOauthRefreshTokenRepositoryInterface::class => ZohoOauthRefreshTokenEloquentRepository::class,
        ZohoOauthAccessTokenRepositoryInterface::class => ZohoOauthAccessTokenEloquentRepository::class,
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
