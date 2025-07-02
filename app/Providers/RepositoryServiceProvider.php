<?php

namespace App\Providers;

use App\Contracts\Repositories\CertRepositoryInterface;
use App\Repositories\CertRepository;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Repositories\DgiiResponse\DgiiResponseRepository;
use App\Repositories\DgiiResponse\DgiiResponseRepositoryInterface;
use App\Repositories\Invoice\InvoiceRepository;
use App\Repositories\Invoice\InvoiceRepositoryInterface;
use App\Repositories\Xml\XmlRepository;
use App\Repositories\Xml\XmlRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected array $repositories = [
        CertRepositoryInterface::class => CertRepository::class,
        CompanyRepositoryInterface::class => CompanyRepository::class,
        DgiiResponseRepositoryInterface::class => DgiiResponseRepository::class,
        InvoiceRepositoryInterface::class => InvoiceRepository::class,
        XmlRepositoryInterface::class => XmlRepository::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
