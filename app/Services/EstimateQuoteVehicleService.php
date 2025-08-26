<?php

namespace App\Services;

use App\Models\VehicleMake;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use App\Services\Api\Zoho\ZohoCRMService;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;

class EstimateQuoteVehicleService
{
    public function __construct(protected ZohoCRMService $zohoApi)
    {
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    public function estimate(float $vehicleAmount, int $vehicleMakeId, int $vehicleModelId, int $vehicleYear, int $vehicleTypeId, ?bool $isEmployee = false, ?bool $leasing = false, ?string $serviceType = null): array
    {
        $vehicleMake = VehicleMake::find($vehicleMakeId);
        $vehicleModel = VehicleModel::find($vehicleModelId);
        $vehicleType = $vehicleModel->type;

        $criteria = '((Corredor:equals:' . 3222373000092390001 . ') and (Product_Category:equals:Auto))';
        $productsResponse = $this->zohoApi->searchRecords('Products', $criteria);

        $result = [];

        foreach ($productsResponse['data'] as $product) {
            $shouldSkip = false;
            $error = '';

        if($serviceType === 'Clásico') {
            $case1 = $product['Plan'] === 'Empleado' && $isEmployee;
            $case2 = $product['Plan'] === 'Clásico';
            $case3 = $product['Plan'] === null;

            if (!$case1 && !$case2 && !$case3) {
                continue;
            }
        }

            if($serviceType === 'Japonés') {
                    $case1 = $product['Plan'] === 'Empleado' && $isEmployee;
                    $case2 = $product['Plan'] === 'Japonés';
                    $case3 = $product['Plan'] === null;

                    if (!$case1 && !$case2 && !$case3) {
                        continue;
                    }
            }


            if($serviceType === '0 KM') {
                    $case1 = $product['Plan'] === 'Empleado' && $isEmployee;
                $case2 = $product['Plan'] === '0 KM';
                $case3 = $product['Plan'] === 'Clásico';
                    $case4 = $product['Plan'] === null;

                    if (!$case1 && !$case2  && !$case3 && !$case4) {
                        continue;
                    }
            }

            if($serviceType === 'Híbrido/Eléctrico') {
                    $case1 = $product['Plan'] === 'Empleado' && $isEmployee;
                    $case2 = $product['Plan'] === 'Híbrido/Eléctrico';
                    $case3 = $product['Plan'] === null;

                    if (!$case1 && !$case2 && !$case3) {
                        continue;
                    }
            }

            try {
                $criteria = 'Aseguradora:equals:' . $product['Vendor_Name']['id'];
                $restrictedVehicles = $this->zohoApi->searchRecords('Restringidos', $criteria);
            } catch (\Throwable $e) {
                //
            }

            if (!empty($restrictedVehicles)) {
                foreach ($restrictedVehicles['data'] as $restricted) {
                    if (\Str::contains(\Str::lower($vehicleMake->name), \Str::lower($restricted['Marca']['name']))) {
                        if (empty($restricted['Modelo'])) {
                            $error = 'Marca restringido';
                            $shouldSkip = true;
                            break;
                        }

                        if (\Str::contains(\Str::lower($vehicleModel->name), \Str::lower($restricted['Modelo']['name']))) {
                            $error = 'Modelo restringido';
                            $shouldSkip = true;
                            break;
                        }
                    }
                }
            }

            $rate = $this->getRate($product['id'], $vehicleAmount, $vehicleYear, $vehicleType);

            if ($shouldSkip) {
                $rate = 0;
            }

            $amount = 0;
            $amountTaxed = 0;
            $taxesAmount = 0;
            $totalMonthly = 0;
            $lifeAmount = 0;

            if ($rate > 0) {
                $amount = $vehicleAmount * ($rate / 100);

                if($serviceType === 'Japonés' && !empty($product['Recargo'])){
                    $amount *= 1.30;
                }

                $amountTaxed = $amount / 1.16;
                $taxesAmount = $amount - $amountTaxed;

                $lifeAmount = 220;

                $totalMonthly = ($amount / 12) + $lifeAmount;

                $amount = $totalMonthly * 12;

                if (!empty($product['Resp_civil']) && $leasing) {
                    $totalMonthly += $product['Leasing_mensual'];
                    $amount = $totalMonthly * 12;
                }
            }else{
                $error = 'No existe tasa para el vehículo';
            }


            $amount = round($amount, 2);
            $amountTaxed = round($amountTaxed, 2);
            $taxesAmount = round($taxesAmount, 2);
            $totalMonthly = round($totalMonthly, 2);

            $vendorCRM = $this->zohoApi->getRecords('Vendors', ['Nombre'], $product['Vendor_Name']['id'])['data'][0];

            $result[] = [
                'name' => $product['Product_Name'],
                'unit_price' => $amount,
                'quantity' => 1,
                'subtotal' => $amount,
                'amount_taxed' => $amountTaxed,
                'tax_rate' => 16,
                'tax_amount' => $taxesAmount,
                'total' => $amount,
                'total_monthly' => $totalMonthly,
                'id_crm' => $product['id'],
                'life_amount' => $lifeAmount,
                'vehicle_rate' => $rate,
                'error' => $error,
                'vendor_name' => $vendorCRM['Nombre'],
            ];
        }

        if($serviceType === '0 KM') {
           array_map(function ($item) {
               if($item['name'] === 'HUMANO SEGUROS'){
                   unset($item);
               }
                return $item;
            }, $result);
        }

            return $result;
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    protected function getRate(string $productId, float $vehicleAmount, int $vehicleYear, VehicleType $vehicleType): float
    {
        $criteria = "((Plan:equals:$productId) and (A_o:equals:$vehicleYear))";
        try {
            $rates = $this->zohoApi->searchRecords('Tasas', $criteria);
        } catch (\Throwable $e) {
            try {
                $criteria = "Plan:equals:$productId";
                $rates = $this->zohoApi->searchRecords('Tasas', $criteria);
            } catch (\Throwable $e) {
                return 0;
            }
        }

        $selectedRate = 0;

        foreach ($rates['data'] as $rate) {
            if (!empty($rate['Grupo_de_veh_culo']) && !in_array($vehicleType->name, $rate['Grupo_de_veh_culo'], true)) {
                continue;
            }

            if (!empty($rate['Suma_hasta']) && $vehicleAmount > $rate['Suma_hasta']) {
                continue;
            }

            if (!empty($rate['Suma_limite']) && $vehicleAmount < $rate['Suma_limite']) {
                continue;
            }

            if (!empty($rate['A_o']) && $rate['A_o'] !== $vehicleYear) {
                continue;
            }

            $selectedRate = $rate['Name'];
        }

        return $selectedRate;
    }
}
