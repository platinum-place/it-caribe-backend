<?php

namespace Modules\Application\Insurances\Products\Pepin\Services;

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
        } catch (\Throwable $e) {
            $criteria = 'Plan:equals:'.$serviceId;
            $rates = $this->findZohoRecord->handle('Tasas', $criteria);
        }

        foreach ($rates['data'] as $rate) {
            if (! empty($rate['A_o']) && $vehicleYear !== $rate['A_o']) {
                continue;
            }

            if (! in_array($vehicleTypeCode, $rate['Grupo_de_veh_culo'], true)) {
                continue;
            }

            if (! empty($rate['Suma_hasta']) && $vehicleAmount > $rate['Suma_hasta']) {
                continue;
            }

            if (! empty($rate['Suma_limite']) && $vehicleAmount < $rate['Suma_limite']) {
                continue;
            }

            $selectedRate = $rate['Name'];
        }

        return $selectedRate;
    }
}
