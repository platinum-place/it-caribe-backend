<?php

namespace Modules\Application\Insurances\Products\Humano\Contracts;

use Modules\Domain\Insurances\Core\ValueObjects\InsuranceQuotation;

interface EstimateHumanoVehicleInsuranceInterface
{
    public function handle(string $vehicleMakeCode, string $vehicleModelCode, string $vehicleTypeCode, string $vehicleUtilityCode, string $vehicleYear, float $vehicleAmount): ?InsuranceQuotation;
}
