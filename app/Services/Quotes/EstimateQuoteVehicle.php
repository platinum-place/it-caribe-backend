<?php

namespace App\Services\Quotes;

use App\Enums\Quotes\QuoteLineStatus;
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
            $taxes = $amount / 1.16;
            $amountTaxed = $amount - $taxes;

            $result[] = [
                'name' => $product['Vendor_Name']['name'],
                'unit_price' => $amount,
                'quantity' => 1,
                'subtotal' => $amount,
                'amount_taxed' => $amountTaxed,
                'tax_rate' => 16,
                'tax_amount' => $taxes,
                'total' => $amount,
                'id_crm' => $product['id'],
                'life_amount' => 220,
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

        $criteria = "((Plan:equals:$productId) and (A_o:equals:$vehicleYear))";
        $rates = $this->zohoApi->searchRecords('Tasas', $criteria);

        foreach ($rates['data'] as $rate) {
            $selectedRate = $rate['Name'];
            break;
        }

        return $selectedRate;
    }
}
