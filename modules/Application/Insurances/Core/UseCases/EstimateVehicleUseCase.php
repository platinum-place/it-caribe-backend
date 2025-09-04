<?php

namespace Modules\Application\Insurances\Core\UseCases;

use Modules\Application\Insurances\Products\Humano\Contracts\EstimateHumanoVehicleInsuranceInterface;
use Modules\Application\Insurances\Products\Monumental\Contracts\EstimateMonumentalVehicleInsuranceInterface;

class EstimateVehicleUseCase
{
    public function __construct(
        protected EstimateHumanoVehicleInsuranceInterface $estimateHumanoVehicleInsurance,
        protected EstimateMonumentalVehicleInsuranceInterface $estimateMonumentalVehicleInsurance
    ) {}

    public function handle(
        string $vehicleMakeCode,
        string $vehicleModelCode,
        string $vehicleTypeCode,
        string $vehicleUtilityCode,
        string $vehicleYear,
        float $vehicleAmount
    ) {
        $result = [];

        $result[] = $this->estimateHumanoVehicleInsurance->handle(
            $vehicleMakeCode,
            $vehicleModelCode,
            $vehicleTypeCode,
            $vehicleUtilityCode,
            $vehicleYear,
            $vehicleAmount
        );

        $result[] = $this->estimateMonumentalVehicleInsurance->handle(
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
