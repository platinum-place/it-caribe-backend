<?php

return [
    App\Providers\AppServiceProvider::class,

    Modules\Infrastructure\Zoho\Providers\AppServiceProvider::class,
    Modules\Infrastructure\Insurances\Products\Humano\Providers\AppServiceProvider::class,
    Modules\Infrastructure\CRM\Providers\AppServiceProvider::class,
    Modules\Infrastructure\Organization\Locations\Providers\AppServiceProvider::class,
    Modules\Infrastructure\Catalogs\Vehicles\Providers\AppServiceProvider::class,

    App\Providers\Filament\AdminPanelProvider::class,
    App\Providers\Filament\BranchPanelProvider::class,
    Spatie\Permission\PermissionServiceProvider::class,
];
