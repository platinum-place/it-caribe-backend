<?php

namespace Modules\Application\Insurances\Products\Humano\Services;

use Modules\Domain\API\Zoho\Contracts\FetchZohoRecordInterface;

class ValidateVehicleRestrictedService
{
    public function __construct(
        protected FetchZohoRecordInterface $findZohoRecord,
    ) {}

    public function handle(string $vehicleMakeCode, string $vehicleModelCode): bool
    {
        try {
            $criteria = 'Aseguradora:equals:'. 3222373000005945077;
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
