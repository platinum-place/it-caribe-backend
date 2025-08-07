<?php

namespace Modules\Common\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Common\Domain\Contracts\AuthenticateCompanyInDgiiInterface;
use Modules\Common\Domain\Contracts\CommercialApprovalXmlInterface;
use Modules\Common\Domain\Contracts\CompanyRepositoryInterface;
use Modules\Common\Domain\Contracts\DgiiApiClientInterface;
use Modules\Common\Domain\Contracts\SignCompanyDocumentInterface;
use Modules\Common\Domain\Contracts\SignManagerInterface;
use Modules\DgiiIntegration\Infrastructure\Http\DgiiApiClient;
use Modules\Signatory\Infrastructure\Adapters\SelectiveSignManagerAdapter;
use Modules\Tenant\Application\UseCases\AuthenticateCompanyInDgiiUseCase;
use Modules\Tenant\Application\UseCases\SignCompanyDocumentUseCase;
use Modules\Tenant\Infrastructure\Persistence\Repositories\EloquentCompanyRepository;
use Modules\XmlRenderer\Application\UseCases\CommercialApprovalXmlUseCase;

class ContractServiceProvider extends ServiceProvider
{
    protected array $classes = [
        SignManagerInterface::class => SelectiveSignManagerAdapter::class,
        SignCompanyDocumentInterface::class => SignCompanyDocumentUseCase::class,
        CommercialApprovalXmlInterface::class => CommercialApprovalXmlUseCase::class,
        DgiiApiClientInterface::class => DgiiApiClient::class,
        CompanyRepositoryInterface::class => EloquentCompanyRepository::class,
        AuthenticateCompanyInDgiiInterface::class => AuthenticateCompanyInDgiiUseCase::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach ($this->classes as $interface => $class) {
            $this->app->bind($interface, $class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
