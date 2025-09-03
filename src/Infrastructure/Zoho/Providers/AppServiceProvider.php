<?php

namespace Modules\Infrastructure\Zoho\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Application\Zoho\Contracts\FetchZohoRecordInterface;
use Modules\Application\Zoho\UseCases\FetchRecordsUseCase;
use Modules\Domain\Zoho\Contracts\ZohoCRMInterface;
use Modules\Domain\Zoho\Repositories\ZohoOauthAccessTokenRepositoryInterface;
use Modules\Domain\Zoho\Repositories\ZohoOauthClientRepositoryInterface;
use Modules\Domain\Zoho\Repositories\ZohoOauthRefreshTokenRepositoryInterface;
use Modules\Infrastructure\Zoho\Adapters\ZohoApiAdapter;
use Modules\Infrastructure\Zoho\Persistence\Repositories\ZohoOauthAccessTokenEloquentRepository;
use Modules\Infrastructure\Zoho\Persistence\Repositories\ZohoOauthClientEloquentRepository;
use Modules\Infrastructure\Zoho\Persistence\Repositories\ZohoOauthRefreshTokenEloquentRepository;

class AppServiceProvider extends ServiceProvider
{
    protected array $contracts = [
        ZohoCRMInterface::class => ZohoApiAdapter::class,
        ZohoOauthAccessTokenRepositoryInterface::class => ZohoOauthAccessTokenEloquentRepository::class,
        ZohoOauthClientRepositoryInterface::class => ZohoOauthClientEloquentRepository::class,
        ZohoOauthRefreshTokenRepositoryInterface::class => ZohoOauthRefreshTokenEloquentRepository::class,
        FetchZohoRecordInterface::class => FetchRecordsUseCase::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->contracts as $interface => $class) {
            $this->app->singleton($interface, $class);
        }

        $this->mergeConfigFrom(base_path('src/Infrastructure/Zoho/Config/zoho.php'), 'zoho');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(base_path('src/Infrastructure/Zoho/Persistence/Migrations'));
    }
}
