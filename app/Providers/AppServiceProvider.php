<?php

namespace App\Providers;

use App\Adapters\ZohoApiAdapter;
use App\Contracts\ZohoCRMInterface;
use App\Contracts\ZohoOauthAccessTokenRepositoryInterface;
use App\Contracts\ZohoOauthClientRepositoryInterface;
use App\Contracts\ZohoOauthRefreshTokenRepositoryInterface;
use App\Repositories\ZohoOauthAccessTokenEloquentRepository;
use App\Repositories\ZohoOauthClientEloquentRepository;
use App\Repositories\ZohoOauthRefreshTokenEloquentRepository;
use Carbon\CarbonInterval;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    protected array $contracts = [
        ZohoCRMInterface::class => ZohoApiAdapter::class,
        ZohoOauthAccessTokenRepositoryInterface::class => ZohoOauthAccessTokenEloquentRepository::class,
        ZohoOauthClientRepositoryInterface::class => ZohoOauthClientEloquentRepository::class,
        ZohoOauthRefreshTokenRepositoryInterface::class => ZohoOauthRefreshTokenEloquentRepository::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->contracts as $interface => $class) {
            $this->app->bind($interface, $class);
        }

        Passport::ignoreRoutes();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Passport::tokensExpireIn(CarbonInterval::days(15));
    }
}
