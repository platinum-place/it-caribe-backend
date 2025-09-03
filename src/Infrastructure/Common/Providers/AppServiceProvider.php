<?php

namespace Modules\Infrastructure\Common\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Domain\Common\Contracts\ZohoCRMInterface;
use Modules\Domain\Common\Repositories\ZohoOauthAccessTokenRepositoryInterface;
use Modules\Domain\Common\Repositories\ZohoOauthClientRepositoryInterface;
use Modules\Domain\Common\Repositories\ZohoOauthRefreshTokenRepositoryInterface;
use Modules\Infrastructure\Common\Adapters\ZohoApiAdapter;
use Modules\Infrastructure\Common\Persistence\Repositories\ZohoOauthAccessTokenEloquentRepository;
use Modules\Infrastructure\Common\Persistence\Repositories\ZohoOauthClientEloquentRepository;
use Modules\Infrastructure\Common\Persistence\Repositories\ZohoOauthRefreshTokenEloquentRepository;

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

        $this->mergeConfigFrom(base_path('src/Infrastructure/Common/Config/zoho.php'), 'zoho');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(base_path('src/Infrastructure/Common/Persistence/Migrations'));
    }
}
