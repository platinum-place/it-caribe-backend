<?php

namespace Modules\Application\Insurances\Products\Sura\Services;

use Modules\Application\Zoho\Contracts\FetchZohoRecordInterface;

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

            $selectedRate = $rates[0]['Name'];
        } catch (\Throwable $e) {
            //
        }

        return $selectedRate;
    }
}
