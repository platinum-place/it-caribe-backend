<?php

namespace App\Providers;

use App\Contracts\Services\CertServiceInterface;
use App\Services\CertService;
use App\Services\Company\CompanyService;
use App\Services\Company\CompanyServiceInterface;
use App\Services\DgiiResponse\DgiiResponseService;
use App\Services\DgiiResponse\DgiiResponseServiceInterface;
use App\Services\Invoice\InvoiceService;
use App\Services\Invoice\InvoiceServiceInterface;
use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
use App\Services\Xml\XmlService;
use App\Services\Xml\XmlServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServicesServiceProvider extends ServiceProvider
{
    protected array $services = [
        CertServiceInterface::class => CertService::class,
        CompanyServiceInterface::class => CompanyService::class,
        DgiiResponseServiceInterface::class => DgiiResponseService::class,
        InvoiceServiceInterface::class => InvoiceService::class,
        UserServiceInterface::class => UserService::class,
        XmlServiceInterface::class => XmlService::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        foreach ($this->services as $interface => $implementation) {
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
