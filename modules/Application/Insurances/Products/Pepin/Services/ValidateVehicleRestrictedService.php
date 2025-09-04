<?php

namespace Modules\Application\Insurances\Products\Pepin\Services;

use Modules\Application\Zoho\Contracts\FetchZohoRecordInterface;

class ValidateVehicleRestrictedService
{
    public function __construct(
        protected FetchZohoRecordInterface $findZohoRecord,
    ) {}

    public function handle(string $vehicleMakeCode, string $vehicleModelCode): bool
    {
        try {
            $criteria = 'Aseguradora:equals:'. 3222373000171500842;
            $restrictedVehicles = $this->findZohoRecord->handle('Restringidos', $criteria);

            foreach ($restrictedVehicles['data'] as $restricted) {
                if (\Str::contains(\Str::lower($vehicleMakeCode), \Str::lower($restricted['Marca']['name']))) {
                    if (empty($restricted['Modelo'])) {
                        return true;
                    }

                    if (\Str::contains(\Str::lower($vehicleModelCode), \Str::lower($restricted['Modelo']['name']))) {
                        return true;
                    }
                }
            }
        } catch (\Throwable $e) {
            //
        }

        return false;
    }
}
