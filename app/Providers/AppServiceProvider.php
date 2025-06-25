<?php

namespace App\Providers;

use App\Http\Controllers\CustomLivewireController;
use Carbon\CarbonInterval;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
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
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
            request()->server->set('HTTPS', request()->header('X-Forwarded-Proto', 'https') == 'https' ? 'on' : 'off');
        }

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->ip());
        });

        Passport::tokensExpireIn(CarbonInterval::days(15));

//        Route::post('/livewire/upload-file', [CustomLivewireController::class, 'handle'])
//            ->name('livewire.upload-file')
//            ->middleware('web');
    }
}
