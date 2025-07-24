<?php

namespace App\Services;

use App\Services\Api\Zoho\ZohoCRMService;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;

class EstimateQuoteLifeService
{
    protected float $debtorRate = 0;

    protected float $coDebtorRate = 0;

    public function __construct(protected ZohoCRMService $zohoApi) {}

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    public function estimate(int $customerAge, int $deadline, float $insuredAmount, ?int $coDebtorAge = null): array
    {
        $criteria = '((Corredor:equals:'. 3222373000092390001 .') and (Product_Category:equals:Vida))';
        $productsResponse = $this->zohoApi->searchRecords('Products', $criteria);

        $result = [];

        foreach ($productsResponse['data'] as $product) {
            $this->getRate($product['id'], $customerAge, $coDebtorAge);

            $debtorRate = $this->debtorRate / 100;
            $coDebtorRate = $this->coDebtorRate / 100;
            $debtorAmount = ($insuredAmount / 1000) * $debtorRate;
            $coDebtorAmount = 0;

            if (! empty($this->coDebtorRate)) {
                $coDebtorAmount = ($insuredAmount / 1000) * ($coDebtorRate - $debtorRate);
            }

            $amount = $debtorAmount + $coDebtorAmount;
            $amountTaxed = $amount / 1.16;
            $taxesAmount = $amount - $amountTaxed;

            $result[] = [
                'name' => $product['Vendor_Name']['name'],
                'unit_price' => $amount,
                'quantity' => 1,
                'subtotal' => $amount,
                'amount_taxed' => $amountTaxed,
                'tax_rate' => 16,
                'tax_amount' => $taxesAmount,
                'total' => $amount,
                'id_crm' => $product['id'],
                'debtor_amount' => $debtorAmount,
                'co_debtor_amount' => $coDebtorAmount,
                'debtor_rate' => $debtorRate,
                'co_debtor_rate' => $coDebtorRate,
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
    protected function getRate(string $productId, $customerAge, ?int $coDebtorAge = null)
    {
        $criteria = "Plan:equals:$productId";
        $rates = $this->zohoApi->searchRecords('Tasas', $criteria);

        foreach ($rates['data'] as $rate) {
            if ($customerAge >= $rate['Edad_min'] && $customerAge <= $rate['Edad_max']) {
                $this->debtorRate = $rate['Name'];
            }

            if (! empty($coDebtorAge)) {
                if ($coDebtorAge >= $rate['Edad_min'] && $coDebtorAge <= $rate['Edad_max']) {
                    $this->coDebtorRate = $rate['Codeudor'];
                }
            }
        }
    }
}
