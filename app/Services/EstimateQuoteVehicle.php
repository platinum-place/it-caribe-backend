<?php

namespace App\Services;

use App\Services\Api\Zoho\ZohoCRMService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;

class EstimateQuoteVehicle
{
    public function __construct(protected ZohoCRMService $zohoApi)
    {
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function estimate(float $vehicleAmount, int $vehicleYear)
    {
        $criteria = '((Corredor:equals:' . 3222373000092390001 . ') and (Product_Category:equals:Auto))';
        $productsResponse = $this->zohoApi->searchRecords('Products', $criteria);

        $result = [];

        foreach ($productsResponse['data'] as $product) {
            $rate = $this->getRate($product['id'], $vehicleYear);

            $amount = $vehicleAmount * ($rate / 100);
            $amountTaxed = $amount / 1.16;
            $taxesAmount = $amount - $amountTaxed;
            $totalMonthly = $amount / 12;

            $result[] = [
                'name' => $product['Vendor_Name']['name'],
                'unit_price' => $amount,
                'quantity' => 1,
                'subtotal' => $amount,
                'amount_taxed' => $amountTaxed,
                'tax_rate' => 16,
                'tax_amount' => $taxesAmount,
                'total' => $amount,
                'total_monthly' => $totalMonthly,
                'id_crm' => $product['id'],
                'life_amount' => 220,
                'insurance_rate' => $rate,
                'error' => null,
            ];
        }

        return $result;
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    protected function getRate(string $productId, int $vehicleYear)
    {
        $selectedRate = null;

        $criteria = "(Plan:equals:$productId)";
        $rates = $this->zohoApi->searchRecords('Tasas', $criteria);

        foreach ($rates['data'] as $rate) {
            if ($rate['A_o'] !== $vehicleYear) {
                continue;
            }

            $selectedRate = $rate['Name'];
            break;
        }

        return $selectedRate;
    }
}
