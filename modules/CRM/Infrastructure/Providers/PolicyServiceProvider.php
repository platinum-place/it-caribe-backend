<?php

namespace Modules\CRM\Infrastructure\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\CRM\Infrastructure\Persistence\Models\Debtor;
use Modules\CRM\Infrastructure\Persistence\Models\DebtorType;
use Modules\CRM\Infrastructure\Policies\DebtorPolicy;
use Modules\CRM\Infrastructure\Policies\DebtorTypePolicy;

class PolicyServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Debtor::class => DebtorPolicy::class,
        DebtorType::class => DebtorTypePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
