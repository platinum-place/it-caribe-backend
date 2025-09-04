<?php

namespace Modules\Application\Insurances\Core\UseCases;

use Modules\Application\Insurances\Products\Angloamericana\Contracts\EstimateVehicleAngloamericanaInterface;
use Modules\Application\Insurances\Products\Humano\Contracts\EstimateVehicleHumanoInterface;
use Modules\Application\Insurances\Products\Monumental\Contracts\EstimateVehicleMonumentalInterface;
use Modules\Application\Insurances\Products\Pepin\Contracts\EstimateVehiclePepinInterface;
use Modules\Application\Insurances\Products\Sura\Contracts\EstimateVehicleSuraInterface;

class EstimateVehicleUseCase
{
    public function __construct(
        protected EstimateVehicleHumanoInterface $estimateVehicleHumano,
        protected EstimateVehicleMonumentalInterface $estimateVehicleMonumental,
        protected EstimateVehicleSuraInterface $estimateVehicleSura,
        protected EstimateVehicleAngloamericanaInterface $estimateVehicleAngloamericana,
        protected EstimateVehiclePepinInterface $estimateVehiclePepin,
    ) {}

    public function handle(
        string $vehicleMakeCode,
        string $vehicleModelCode,
        string $vehicleTypeCode,
        string $vehicleUtilityCode,
        string $vehicleYear,
        float $vehicleAmount,
        bool $isEmployee,
        bool $leasing,
    ) {
        $result = [];

        $result[] = $this->estimateVehicleHumano->handle(
            $vehicleMakeCode,
            $vehicleModelCode,
            $vehicleTypeCode,
            $vehicleUtilityCode,
            $vehicleYear,
            $vehicleAmount,
        );

        $result[] = $this->estimateVehicleMonumental->handle(
            $vehicleMakeCode,
            $vehicleModelCode,
            $vehicleTypeCode,
            $vehicleUtilityCode,
            $vehicleYear,
            $vehicleAmount,
        );

        if ($isEmployee) {
            $result[] = $this->estimateVehicleSura->handle(
                $vehicleMakeCode,
                $vehicleModelCode,
                $vehicleTypeCode,
                $vehicleUtilityCode,
                $vehicleYear,
                $vehicleAmount,
            );
        }

        $result[] = $this->estimateVehicleAngloamericana->handle(
            $vehicleMakeCode,
            $vehicleModelCode,
            $vehicleTypeCode,
            $vehicleUtilityCode,
            $vehicleYear,
            $vehicleAmount,
            $leasing
        );

        $result[] = $this->estimateVehiclePepin->handle(
            $vehicleMakeCode,
            $vehicleModelCode,
            $vehicleTypeCode,
            $vehicleUtilityCode,
            $vehicleYear,
            $vehicleAmount,
            $leasing
        );

        return array_filter($result);
    }
}
