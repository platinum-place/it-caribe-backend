<?php

namespace App\Services\Quotes;

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

            dd($amount);
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
        $criteria = "Plan:equals:$productId";
        $rates = $this->zohoApi->searchRecords('Tasas', $criteria);
        foreach ($rates as $rate) {
            if ($rate['A_o'] === $vehicleYear) {
                $selectedRate = $rate['Name'];
                break;
            }
        }

        return $selectedRate;
    }
}
