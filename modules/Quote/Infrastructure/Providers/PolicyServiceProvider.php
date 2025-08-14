<?php

namespace Modules\Quote\Infrastructure\Providers;

use App\Models\Quote\Quote;
use App\Models\Quote\QuoteLine;
use App\Models\Quote\QuoteLineStatus;
use App\Models\Quote\QuoteStatus;
use App\Models\Quote\QuoteType;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
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
