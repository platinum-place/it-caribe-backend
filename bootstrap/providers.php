<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\PassportServiceProvider::class,
    SimpleSoftwareIO\QrCode\QrCodeServiceProvider::class,

    /**
     * Modules
     */
    Modules\Common\AppServiceProvider::class,
    Modules\Vehicle\AppServiceProvider::class,
    Modules\CRM\AppServiceProvider::class,
    Modules\Quote\AppServiceProvider::class,
];
