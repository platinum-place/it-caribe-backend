<?php

namespace Modules\DgiiIntegration\Infrastructure\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::middleware('api')
            ->name('Modules\DgiiIntegration\Presentation\Http')
            ->prefix('api')
            ->group(__DIR__.'/../../Presentation/Http/routes.php');
    }
}
