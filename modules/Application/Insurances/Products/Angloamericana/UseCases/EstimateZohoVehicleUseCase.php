<?php

namespace Modules\Application\Insurances\Products\Angloamericana\UseCases;

use Modules\Application\Insurances\Products\Angloamericana\Contracts\EstimateVehicleAngloamericanaInterface;
use Modules\Application\Insurances\Products\Angloamericana\Services\FetchVehicleRateService;
use Modules\Application\Insurances\Products\Angloamericana\Services\ValidateVehicleRestrictedService;
use Modules\Application\Zoho\Contracts\FetchZohoRecordInterface;
use Modules\Domain\Insurances\Core\ValueObjects\InsuranceQuotation;

class EstimateZohoVehicleUseCase implements EstimateVehicleAngloamericanaInterface
{
    public function __construct(
        protected FetchZohoRecordInterface $findZohoRecord,
        protected ValidateVehicleRestrictedService $validateRestrictedService,
        protected FetchVehicleRateService $fetchVehicleRateService,
    ) {}

    public function handle(
        string $vehicleMakeCode,
        string $vehicleModelCode,
        string $vehicleTypeCode,
        string $vehicleUtilityCode,
        string $vehicleYear,
        float $vehicleAmount,
        bool $leasing
    ): ?InsuranceQuotation {
        if ($this->validateRestrictedService->handle($vehicleMakeCode, $vehicleModelCode)) {
            return null;
        }

        $r = null;

        $criteria = '((Vendor_Name:equals:'. 3222373000005945063 .') and (Corredor:equals:'. 3222373000092390001 .') and (Product_Category:equals:Auto))';
        $records = $this->findZohoRecord->handle('Products', $criteria);

        //        $services = array_column($records, 'Plan');

        //        if (! in_array($vehicleUtilityCode, $services, true)) {
        //            $vehicleUtilityCode = 'Clásico';
        //        }

        foreach ($records as $record) {
            if ($record['Plan'] !== $vehicleUtilityCode) {
                continue;
            }

            $rate = $this->fetchVehicleRateService->handle($record['id'], $vehicleYear, $vehicleTypeCode, $vehicleAmount);

            if ($rate === 0) {
                continue;
            }

            $amount = $vehicleAmount * ($rate / 100);

            $amountTaxed = $amount / 1.16;
            $taxesAmount = $amount - $amountTaxed;

            $lifeAmount = 220;

            $totalMonthly = ($amount / 12) + $lifeAmount;

            $amount = $totalMonthly * 12;

            if (! empty($record['Resp_civil']) && $leasing) {
                $totalMonthly += $record['Leasing_mensual'];
                $amount = $totalMonthly * 12;
            }

            $r = new InsuranceQuotation(
                120,
                20,
                80,
                $rate,
                $record['id'],
                'Angloamericana',
                round($amountTaxed, 2),
                16,
                round($taxesAmount, 2),
                round($amount, 2),
                round($totalMonthly, 2),
                round($amount - 120, 2),
            );
        }

        return $r;
    }
}
