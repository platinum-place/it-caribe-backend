<?php

namespace Modules\Quote\Submodules\Vehicle\Domain\Contracts;

interface EstimateVehicleQuoteInterface
{
    public function handle(
        float $vehicleAmount, int $vehicleMakeId, int $vehicleModelId,
        int $vehicleYear, int $vehicleTypeId, int $vehicleUtilityId,
        ?bool $isEmployee = false, bool $leasing = false
    );
}
