<?php

namespace Modules\Application\Insurance\UseCases;

use Modules\Application\Humano\Contracts\EstimateHumanoVehicleInsuranceInterface;

class EstimateVehicleUseCase
{
    public function __construct(
        protected EstimateHumanoVehicleInsuranceInterface $estimateHumanoVehicleInsurance
    ) {}

    public function handle(
        string $vehicleMakeCode,
        string $vehicleModelCode,
        string $vehicleTypeCode,
        string $vehicleUtilityCode,
        string $vehicleYear,
        float $vehicleAmount
    ) {
        $result[] = $this->estimateHumanoVehicleInsurance->handle(
            $vehicleMakeCode,
            $vehicleModelCode,
            $vehicleTypeCode,
            $vehicleUtilityCode,
            $vehicleYear,
            $vehicleAmount
        );

        return $result;
    }
}
