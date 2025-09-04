<?php

namespace Modules\Application\Insurances\Products\Pepin\Contracts;

use Modules\Domain\Insurances\Core\ValueObjects\InsuranceQuotation;

interface EstimateVehiclePepinInterface
{
    public function handle(
        string $vehicleMakeCode,
        string $vehicleModelCode,
        string $vehicleTypeCode,
        string $vehicleUtilityCode,
        string $vehicleYear,
        float $vehicleAmount,
        bool $leasing
    ): ?InsuranceQuotation;
}
