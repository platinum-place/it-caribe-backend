<?php

namespace Modules\Vehicle\Infrastructure\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleAccessory;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleActivity;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleColor;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleLoanType;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleMake;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleModel;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleRoute;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleType;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleUse;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleUtility;
use Modules\Vehicle\Infrastructure\Policies\VehicleAccessoryPolicy;
use Modules\Vehicle\Infrastructure\Policies\VehicleActivityPolicy;
use Modules\Vehicle\Infrastructure\Policies\VehicleColorPolicy;
use Modules\Vehicle\Infrastructure\Policies\VehicleLoanTypePolicy;
use Modules\Vehicle\Infrastructure\Policies\VehicleMakePolicy;
use Modules\Vehicle\Infrastructure\Policies\VehicleModelPolicy;
use Modules\Vehicle\Infrastructure\Policies\VehicleRoutePolicy;
use Modules\Vehicle\Infrastructure\Policies\VehicleTypePolicy;
use Modules\Vehicle\Infrastructure\Policies\VehicleUsePolicy;
use Modules\Vehicle\Infrastructure\Policies\VehicleUtilityPolicy;

class PolicyServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        VehicleUse::class => VehicleUsePolicy::class,
        VehicleMake::class => VehicleMakePolicy::class,
        VehicleType::class => VehicleTypePolicy::class,
        VehicleColor::class => VehicleColorPolicy::class,
        VehicleModel::class => VehicleModelPolicy::class,
        VehicleRoute::class => VehicleRoutePolicy::class,
        VehicleUtility::class => VehicleUtilityPolicy::class,
        VehicleActivity::class => VehicleActivityPolicy::class,
        VehicleLoanType::class => VehicleLoanTypePolicy::class,
        VehicleAccessory::class => VehicleAccessoryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
