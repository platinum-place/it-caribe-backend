<?php

namespace Modules\Application\Insurances\Products\Monumental\Services;

use Modules\Domain\API\Zoho\Contracts\FetchZohoRecordInterface;

class FetchVehicleRateService
{
    public function __construct(
        protected FetchZohoRecordInterface $findZohoRecord,
    ) {}

    public function handle(string $serviceId, string $vehicleYear, string $vehicleTypeCode, float $vehicleAmount)
    {
        $selectedRate = 0;

        try {
            $criteria = '((Plan:equals:'.$serviceId.") and (A_o:equals:$vehicleYear))";
            $rates = $this->findZohoRecord->handle('Tasas', $criteria);

            foreach ($rates['data'] as $rate) {
                if (! in_array($vehicleTypeCode, $rate['Grupo_de_veh_culo'], true)) {
                    continue;
                }

                $selectedRate = $rate['Name'];
            }
        } catch (\Throwable $e) {
            //
        }

        return $selectedRate;
    }
}
