<?php

namespace Modules\Quote\Vehicle\Infrastructure\Providers;

use;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Quote\Submodules\Vehicle\Infrastructure\Policies\QuoteVehicleLinePolicy;
use Modules\Quote\Vehicle\Infrastructure\Persistence\Models\QuoteVehicle;
use Modules\Quote\Vehicle\Infrastructure\Persistence\Models\QuoteVehicleLine;
use Modules\Quote\Vehicle\Infrastructure\Policies\QuoteVehiclePolicy;

class PolicyServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        QuoteVehicle::class => QuoteVehiclePolicy::class,
        QuoteVehicleLine::class => QuoteVehicleLinePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
