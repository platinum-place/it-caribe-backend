<?php

namespace App\Services\Quote\Vehicle;

use App\Models\Vehicle\VehicleMake;
use App\Models\Vehicle\VehicleModel;
use App\Models\Vehicle\VehicleType;
use App\Models\Vehicle\VehicleUtility;
use App\Services\Api\Zoho\ZohoService;

class EstimateQuoteVehicleService
{
    public function __construct(protected ZohoService $zohoService) {}

    public function handle(
        float $vehicleAmount, int $vehicleMakeId, int $vehicleModelId,
        int $vehicleYear, int $vehicleTypeId, int $vehicleUtilityId,
        ?bool $isEmployee = false, bool $leasing = false
    ) {
        $vehicleMake = VehicleMake::find($vehicleMakeId);
        $vehicleModel = VehicleModel::find($vehicleModelId);
        $vehicleType = VehicleType::find($vehicleTypeId);
        $vehicleUtility = VehicleUtility::find($vehicleUtilityId);

        $criteria = '((Corredor:equals:'. 3222373000092390001 .') and (Product_Category:equals:Auto))';
        $productsResponse = $this->zohoService->searchRecords('Products', $criteria);

        $result = [];

        foreach ($productsResponse['data'] as $product) {
            $shouldSkip = false;
            $error = '';

            if (! empty($product['Plan'])) {
                if ($product['Plan'] === 'Empleado' && ! $isEmployee) {
                    continue;
                }

                if ($product['Plan'] !== 'Empleado' && $product['Plan'] !== $vehicleUtility->name) {
                    continue;
                }
            }

            try {
                $criteria = 'Aseguradora:equals:'.$product['Vendor_Name']['id'];
                $restrictedVehicles = $this->zohoService->searchRecords('Restringidos', $criteria);
            } catch (\Throwable $e) {
                //
            }

            if (! empty($restrictedVehicles)) {
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

            //            if ($shouldSkip) {
            //                continue;
            //            }

            $rate = empty($error) ? $this->getRate($product['id'], $vehicleAmount, $vehicleYear, $vehicleType) : 0;

            $amount = 0;
            $amountTaxed = 0;
            $taxesAmount = 0;
            $totalMonthly = 0;
            $lifeAmount = 0;
            $latestExpenses = 0;
            $markup = 0;

            if ($rate > 0) {
                $amount = $vehicleAmount * ($rate / 100);

                if ($amount < $product['Prima_m_nima']) {
                    $amount = $product['Prima_m_nima'];
                }

                $amountTaxed = $amount / 1.16;
                $taxesAmount = $amount - $amountTaxed;

                $lifeAmount = 120;
                $latestExpenses = 20;
                $markup = 80;

                $totalMonthly = ($amount / 12) + $lifeAmount + $latestExpenses + $markup;

                $amount = $totalMonthly * 12;

                if (! empty($product['Resp_civil']) && $leasing) {
                    $totalMonthly += $product['Leasing_mensual'];
                    $amount = $totalMonthly * 12;
                }
            }

            //            if ($rate == 0 && $error == '') {
            //                continue;
            //            }

            $amount = round($amount, 2);
            $amountTaxed = round($amountTaxed, 2);
            $taxesAmount = round($taxesAmount, 2);
            $totalMonthly = round($totalMonthly, 2);

            $vendorCRM = $this->zohoService->getRecords('Vendors', ['Nombre'], $product['Vendor_Name']['id'])['data'][0];

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
                'description' => $product['id'],
                'life_amount' => $lifeAmount,
                'latest_expenses' => $latestExpenses,
                'markup' => $markup,
                'vehicle_rate' => $rate,
                'error' => $error,
                'vendor_name' => $vendorCRM['Nombre'],
            ];
        }

        return $result;
    }

    protected function getRate(string $productId, float $vehicleAmount, int $vehicleYear, VehicleType $vehicleType): float
    {
        try {
            $criteria = "((Plan:equals:$productId) and (A_o:equals:$vehicleYear))";
            $rates = $this->zohoService->searchRecords('Tasas', $criteria);
        } catch (\Throwable $e) {
            //
        }

        try {
            $criteria = "Plan:equals:$productId";
            $rates = $this->zohoService->searchRecords('Tasas', $criteria);
        } catch (\Throwable $e) {
            //
        }

        if (empty($rates['data'])) {
            return 0;
        }

        $selectedRate = 0;

        foreach ($rates['data'] as $rate) {
            if (! empty($rate['Grupo_de_veh_culo']) && ! in_array($vehicleType->name, $rate['Grupo_de_veh_culo'], true)) {
                continue;
            }

            if (! empty($rate['Suma_hasta']) && $vehicleAmount > $rate['Suma_hasta']) {
                continue;
            }

            if (! empty($rate['Suma_limite']) && $vehicleAmount < $rate['Suma_limite']) {
                continue;
            }

            if (! empty($rate['A_o']) && $rate['A_o'] !== $vehicleYear) {
                continue;
            }

            $selectedRate = $rate['Name'];
        }

        return $selectedRate;
    }
}
