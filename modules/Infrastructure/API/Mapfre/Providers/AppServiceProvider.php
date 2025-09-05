<?php

namespace Modules\Infrastructure\API\Mapfre\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Application\API\Zoho\UseCases\FetchRecordsUseCase;
use Modules\Domain\API\Zoho\Contracts\FetchZohoRecordInterface;
use Modules\Domain\API\Zoho\Contracts\ZohoCRMInterface;
use Modules\Domain\API\Zoho\Contracts\ZohoOauthAccessTokenRepositoryInterface;
use Modules\Domain\API\Zoho\Contracts\ZohoOauthRefreshTokenRepositoryInterface;
use Modules\Infrastructure\API\Zoho\Adapters\ZohoApiAdapter;
use Modules\Infrastructure\API\Zoho\Persistence\Repositories\ZohoOauthAccessTokenEloquentRepository;
use Modules\Infrastructure\API\Zoho\Persistence\Repositories\ZohoOauthRefreshTokenEloquentRepository;
use Modules\Infrastructure\API\Zoho\Providers\FilamentServiceProvider;

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
            $this->app->singleton($interface, $class);
        }

        $this->mergeConfigFrom(
            base_path('modules/Infrastructure/API/Mapfre/Config/mapfre.php'),
            'mapfre'
        );

        $this->app->register(FilamentServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(
            base_path('modules/Infrastructure/API/Mapfre/Persistence/Migrations')
        );
    }
}
