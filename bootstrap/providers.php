<?php

return [
    App\Providers\AppServiceProvider::class,
    Modules\Infrastructure\Common\Providers\AppServiceProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
    App\Providers\Filament\BranchPanelProvider::class,
    Spatie\Permission\PermissionServiceProvider::class,
];
