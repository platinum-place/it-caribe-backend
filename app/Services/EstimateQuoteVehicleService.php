<?php

namespace App\Services;

use App\Models\VehicleType;
use App\Services\Api\Zoho\ZohoCRMService;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;

class EstimateQuoteVehicleService
{
    public function __construct(protected ZohoCRMService $zohoApi) {}

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    public function estimate(float $vehicleAmount, int $vehicleYear, int $vehicleTypeId): array
    {
        $vehicleType = VehicleType::find($vehicleTypeId);

        $criteria = '((Corredor:equals:'. 3222373000092390001 .') and (Product_Category:equals:Auto))';
        $productsResponse = $this->zohoApi->searchRecords('Products', $criteria);

        $result = [];

        foreach ($productsResponse['data'] as $product) {
            $rate = $this->getRate($product['id'], $vehicleAmount, $vehicleYear, $vehicleType);

            $amount = 0;
            $amountTaxed = 0;
            $taxesAmount = 0;
            $totalMonthly = 0;
            $lifeAmount = 0;

            if ($rate > 0) {
                $amount = $vehicleAmount * ($rate / 100);
                $amountTaxed = $amount / 1.16;
                $taxesAmount = $amount - $amountTaxed;
                $totalMonthly = $amount / 12;

                $lifeAmount = 220;

                $amount += $lifeAmount;
            }

            $result[] = [
                'name' => $product['Vendor_Name']['name'],
                'unit_price' => round($amount, 2),
                'quantity' => 1,
                'subtotal' => round($amount, 2),
                'amount_taxed' => round($amountTaxed, 2),
                'tax_rate' => 16,
                'tax_amount' => round($taxesAmount, 2),
                'total' => round($amount, 2),
                'total_monthly' => round($totalMonthly, 2),
                'id_crm' => $product['id'],
                'life_amount' => $lifeAmount,
                'vehicle_rate' => $rate,
                'error' => null,
            ];
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
            $criteria = "Plan:equals:$productId";
            $rates = $this->zohoApi->searchRecords('Tasas', $criteria);
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
