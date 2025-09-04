<?php

namespace Modules\Infrastructure\Quotations\Core\Providers;

use Illuminate\Support\ServiceProvider;

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

        $this->app->register(FilamentServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(
            base_path('modules/Infrastructure/Quotations/Core/Persistence/Migrations')
        );
    }
}
