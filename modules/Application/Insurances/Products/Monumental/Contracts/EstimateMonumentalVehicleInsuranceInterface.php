<?php

namespace Modules\Application\Insurances\Products\Monumental\Contracts;

use Modules\Domain\Insurances\Core\ValueObjects\InsuranceQuotation;

interface EstimateMonumentalVehicleInsuranceInterface
{
    public function handle(string $vehicleMakeCode, string $vehicleModelCode, string $vehicleTypeCode, string $vehicleUtilityCode, string $vehicleYear, float $vehicleAmount): ?InsuranceQuotation;
}
