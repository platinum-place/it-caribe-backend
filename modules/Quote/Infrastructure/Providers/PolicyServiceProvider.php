<?php

namespace Modules\Quote\Infrastructure\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Quote\Infrastructure\Persistence\Models\Quote;
use Modules\Quote\Infrastructure\Persistence\Models\QuoteLine;
use Modules\Quote\Infrastructure\Persistence\Models\QuoteLineStatus;
use Modules\Quote\Infrastructure\Persistence\Models\QuoteStatus;
use Modules\Quote\Infrastructure\Persistence\Models\QuoteType;
use Modules\Quote\Infrastructure\Policies\QuoteLinePolicy;
use Modules\Quote\Infrastructure\Policies\QuoteLineStatusPolicy;
use Modules\Quote\Infrastructure\Policies\QuotePolicy;
use Modules\Quote\Infrastructure\Policies\QuoteStatusPolicy;
use Modules\Quote\Infrastructure\Policies\QuoteTypePolicy;

class PolicyServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Quote::class => QuotePolicy::class,
        QuoteLine::class => QuoteLinePolicy::class,
        QuoteType::class => QuoteTypePolicy::class,
        QuoteStatus::class => QuoteStatusPolicy::class,
        QuoteLineStatus::class => QuoteLineStatusPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
