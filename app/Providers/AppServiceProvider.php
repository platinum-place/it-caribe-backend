<?php

namespace App\Providers;

use Carbon\CarbonInterval;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Modules\Domain\API\Zoho\Contracts\ZohoCRMInterface;
use Modules\Domain\API\Zoho\Contracts\ZohoOauthAccessTokenRepositoryInterface;
use Modules\Domain\API\Zoho\Contracts\ZohoOauthRefreshTokenRepositoryInterface;
use Modules\Domain\API\Zoho\Repositories\ZohoOauthClientRepositoryInterface;
use Modules\Infrastructure\API\Zoho\Adapters\ZohoApiAdapter;
use Modules\Infrastructure\API\Zoho\Persistence\Repositories\ZohoOauthAccessTokenEloquentRepository;
use Modules\Infrastructure\API\Zoho\Persistence\Repositories\ZohoOauthClientEloquentRepository;
use Modules\Infrastructure\API\Zoho\Persistence\Repositories\ZohoOauthRefreshTokenEloquentRepository;

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
