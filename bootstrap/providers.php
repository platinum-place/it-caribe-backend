<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
    App\Providers\PassportServiceProvider::class,
    SimpleSoftwareIO\QrCode\QrCodeServiceProvider::class,

    /** Modules */
    Modules\Common\CommonServiceProvider::class,
    Modules\Vehicle\AppServiceProvider::class,
    Modules\ZohoIntegration\AppServiceProvider::class,
    Modules\CRM\AppServiceProvider::class,
    Modules\Quote\AppServiceProvider::class,
];
