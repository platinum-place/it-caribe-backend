<?php

namespace Modules\Application\Insurances\Products\Sura\Contracts;

use Modules\Domain\Insurances\Core\ValueObjects\InsuranceQuotation;

interface EstimateVehicleSuraInterface
{
    public function handle(
        string $vehicleMakeCode,
        string $vehicleModelCode,
        string $vehicleTypeCode,
        string $vehicleUtilityCode,
        string $vehicleYear,
        float $vehicleAmount
    ): ?InsuranceQuotation;
}
