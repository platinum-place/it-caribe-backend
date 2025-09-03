<?php

namespace Modules\Application\Humano\UseCases;

use Modules\Application\Common\Contracts\FetchZohoRecordInterface;
use Modules\Application\Humano\Services\FetchVehicleRateService;
use Modules\Application\Humano\Services\ValidateVehicleRestrictedService;
use Modules\Domain\Common\ValueObjects\InsuranceQuotation;

class EstimateVehicleUseCase
{
    public function __construct(
        protected FetchZohoRecordInterface         $findZohoRecord,
        protected ValidateVehicleRestrictedService $validateRestrictedService,
        protected FetchVehicleRateService          $fetchVehicleRateService,
    )
    {
    }

    public function handle(string $vehicleMakeCode, string $vehicleModelCode, string $vehicleTypeCode, string $vehicleUtilityCode, string $vehicleYear, float $vehicleAmount)
    {
        if ($this->validateRestrictedService->handle($vehicleMakeCode, $vehicleModelCode)) {
            return null;
        }

        $r = [];
        $criteria = '((Vendor_Name:equals:' . 3222373000005945077 . ') and (Corredor:equals:' . 3222373000092390001 . ') and (Product_Category:equals:Auto))';
        $records = $this->findZohoRecord->handle('Products', $criteria);

        foreach ($records as $record) {
            if ($record['Plan'] !== $vehicleUtilityCode) {
                continue;
            }

            $rate = $this->fetchVehicleRateService->handle($record['id'], $vehicleYear, $vehicleTypeCode, $vehicleAmount);

            if ($rate === 0) {
                continue;
            }

            $amount = $vehicleAmount * ($rate / 100);

            if ($vehicleTypeCode === 'Japonés' && !empty($record['Recargo'])) {
                $amount *= 1.30;
            }

            $amountTaxed = $amount / 1.16;
            $taxesAmount = $amount - $amountTaxed;

            $lifeAmount = 220;

            $totalMonthly = ($amount / 12) + $lifeAmount;

            $amount = $totalMonthly * 12;

            $r = new InsuranceQuotation(
                220,
                $rate,
                $record['id'],
                'Humano',
                round($amountTaxed, 2),
                16,
                round($taxesAmount, 2),
                round($amount, 2),
                round($totalMonthly, 2),
            );
        }

        return $r;
    }
}
