<?php

namespace App\Services;

use App\Services\Api\Zoho\ZohoCRMService;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;

class EstimateQuoteFireService
{
    protected float $debtorRate = 0;

    protected float $coDebtorRate = 0;

    public function __construct(protected ZohoCRMService $zohoApi) {}

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    public function estimate(int $customerAge, int $deadline, float $propertyValue, ?float $loanValue = 0, ?int $coDebtorAge = null): array
    {
        $criteria = '((Corredor:equals:'. 3222373000092390001 .') and (Product_Category:equals:Incendio))';
        $productsResponse = $this->zohoApi->searchRecords('Products', $criteria);

        $result = [];

        foreach ($productsResponse['data'] as $product) {
            /**
             * Estimate fire
             */
            $fireRate = $this->getFireRate($product['id']);
            $fireAmount = ($propertyValue / 1000) * ($fireRate / 100);

            /**
             * Estimate life
             */
            $lifeAmount = 0;
            $debtorRate = 0;
            $coDebtorRate = 0;
            $debtorAmount = 0;
            $coDebtorAmount = 0;
            if ($loanValue) {
                $this->getDebtorRate($product['id'], $customerAge, $coDebtorAge);

                $debtorRate = $this->debtorRate / 100;
                $coDebtorRate = $this->coDebtorRate / 100;
                $debtorAmount = ($loanValue / 1000) * $debtorRate;
            }
            if (! empty($this->coDebtorRate)) {
                $coDebtorAmount = ($loanValue / 1000) * ($coDebtorRate - $debtorRate);
            }
            $lifeAmount = $debtorAmount + $coDebtorAmount;

            /**
             * Totals
             */
            $amount = $lifeAmount + $fireAmount;
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
                'fire_rate' => $fireRate,
                'fire_amount' => $fireAmount,
                'life_amount' => $lifeAmount,
                'property_value' => $propertyValue,
                'loan_value' => $loanValue,
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
    protected function getDebtorRate(string $productId, $customerAge, ?int $coDebtorAge = null): void
    {
        $criteria = "((Plan:equals:$productId) and (Tipo:equals:Vida))";
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

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    protected function getFireRate(string $productId)
    {
        $selectedRate = 0;

        $criteria = "((Plan:equals:$productId) and (Tipo:equals:Incendio))";
        $rates = $this->zohoApi->searchRecords('Tasas', $criteria);

        foreach ($rates['data'] as $rate) {
            $selectedRate = $rate['Name'];
            break;
        }

        return $selectedRate;
    }
}
