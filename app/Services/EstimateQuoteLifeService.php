<?php

namespace App\Services;

use App\Services\Api\Zoho\ZohoCRMService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;

class EstimateQuoteLifeService
{
    public function __construct(protected ZohoCRMService $zohoApi) {}

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    public function estimate(string $debtorBirthDate, int $deadline, float $insuredAmount, ?string $coDebtorBirthDate = null): array
    {
        $criteria = '((Corredor:equals:'. 3222373000092390001 .') and (Product_Category:equals:Vida))';
        $productsResponse = $this->zohoApi->searchRecords('Products', $criteria);

        $result = [];

        $debtorAge = Carbon::parse($debtorBirthDate)->age;

        foreach ($productsResponse['data'] as $product) {
            if ($product['Edad_tasa']) {
                $debtorAge += $deadline / 12;
            }

            $debtorRate = 0;
            $coDebtorRate = 0;

            $debtorAmount = 0;
            $coDebtorAmount = 0;

            $debtorRate = $this->getDebtorRate($product['id'], $debtorAge);
            $debtorAmount = ($insuredAmount / 1000) * ($debtorRate / 100);

            if (! empty($coDebtorBirthDate)) {
                $coDebtorAge = Carbon::parse($coDebtorBirthDate)->age;

                if ($product['Edad_tasa']) {
                    $coDebtorAge += $deadline / 12;
                }

                $coDebtorRate = $this->getCodebtorRate($product['id'], $coDebtorAge);
                $coDebtorAmount = ($insuredAmount / 1000) * (($coDebtorRate - $debtorRate) / 100);
            }

            $amount = $debtorAmount + $coDebtorAmount;
            $amountTaxed = $amount / 1.16;
            $taxesAmount = $amount - $amountTaxed;

            $amount = round($amount, 2);
            $amountTaxed = round($amountTaxed, 2);
            $taxesAmount = round($taxesAmount, 2);
            $debtorAmount = round($debtorAmount, 2);
            $coDebtorAmount = round($coDebtorAmount, 2);

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
    protected function getDebtorRate(string $productId, int $debtorAge)
    {
        $criteria = "((Plan:equals:$productId) and (Tipo:equals:Deudor))";
        $rates = $this->zohoApi->searchRecords('Tasas', $criteria);

        $selectedRate = 0;

        foreach ($rates['data'] as $rate) {
            if ($debtorAge >= $rate['Edad_min'] && $debtorAge <= $rate['Edad_max']) {
                $selectedRate = $rate['Name'];
            }
        }

        return $selectedRate;
    }

    protected function getCodebtorRate(string $productId, int $coDebtorAge)
    {
        $criteria = "((Plan:equals:$productId) and (Tipo:equals:Codeudor))";
        $rates = $this->zohoApi->searchRecords('Tasas', $criteria);

        $selectedRate = 0;

        foreach ($rates['data'] as $rate) {
            if ($coDebtorAge >= $rate['Edad_min'] && $coDebtorAge <= $rate['Edad_max']) {
                $selectedRate = $rate['Name'];
            }
        }

        return $selectedRate;
    }
}
