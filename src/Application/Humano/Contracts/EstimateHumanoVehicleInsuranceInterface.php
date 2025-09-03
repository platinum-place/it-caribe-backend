<?php

namespace Modules\Application\Humano\Contracts;

use Modules\Domain\Insurance\ValueObjects\InsuranceQuotation;

interface EstimateHumanoVehicleInsuranceInterface
{
    public function handle(string $vehicleMakeCode, string $vehicleModelCode, string $vehicleTypeCode, string $vehicleUtilityCode, string $vehicleYear, float $vehicleAmount): ?InsuranceQuotation;
}
