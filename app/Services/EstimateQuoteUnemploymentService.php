<?php

namespace App\Services;

use App\Enums\QuoteFireRiskType;
use App\Models\QuoteUnemploymentType;
use App\Models\QuoteUnemploymentUseType;
use App\Models\VehicleType;
use App\Services\Api\Zoho\ZohoCRMService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;

class EstimateQuoteUnemploymentService
{
    public function __construct(protected ZohoCRMService $zohoApi)
    {
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    public function estimate(string $debtorBirthDate, float $loanInstallment, int $deadline, int $quoteUnemploymentTypeId, int $quoteUnemploymentUseTypeId): array
    {
        $quoteUnemploymentType = QuoteUnemploymentType::findOrFail($quoteUnemploymentTypeId)->name;

        $criteria = '((Corredor:equals:' . 3222373000092390001 . ') and (Product_Category:equals:Desempleo))';
        $productsResponse = $this->zohoApi->searchRecords('Products', $criteria);

        $result = [];

        foreach ($productsResponse['data'] as $product) {
            if ($product['Plan'] !== $quoteUnemploymentType) {
                continue;
            }

            $rate = $this->getRate($debtorBirthDate, $product['id'], $quoteUnemploymentUseTypeId, $loanInstallment);

            $amount = $loanInstallment * ($rate / 100) * $product['Indemnizaci_n'] * $deadline;
            $amountTaxed = $amount / 1.16;
            $taxesAmount = $amount - $amountTaxed;

            $amount = round($amount, 2);
            $amountTaxed = round($amountTaxed, 2);
            $taxesAmount = round($taxesAmount, 2);

            $result[] = [
                'name' => $product['Vendor_Name']['name'],
                'unit_price' => $amount,
                'quantity' => 1,
                'subtotal' => $amount,
                'amount_taxed' => $amountTaxed,
                'tax_rate' => 16,
                'tax_amount' => $taxesAmount,
                'total' => $amount,
                'rate' => $rate,
                'id_crm' => $product['id'],
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
    protected function getRate(string $debtorBirthDate, string $productId, string $quoteUnemploymentUseTypeId, float $loanInstallment)
    {
        $debtorAge = Carbon::parse($debtorBirthDate)->age;
        $quoteUnemploymentUseType = QuoteUnemploymentUseType::findOrFail($quoteUnemploymentUseTypeId)->name;

        $selectedRate = 0;

        try {
            $criteria = "((Plan:equals:$productId) and (Tipo:equals:$quoteUnemploymentUseType))";
            $rates = $this->zohoApi->searchRecords('Tasas', $criteria);

            foreach ($rates['data'] as $rate) {
                if ($debtorAge >= $rate['Edad_min'] && $debtorAge <= $rate['Edad_max']) {
                    $selectedRate = $rate['Name'];
                }
            }
        } catch (\Throwable $e) {
            $criteria = "Plan:equals:$productId";
            $rates = $this->zohoApi->searchRecords('Tasas', $criteria);

            foreach ($rates['data'] as $rate) {
                if ($loanInstallment >= $rate['Suma_limite'] && $loanInstallment <= $rate['Suma_hasta']) {
                    $selectedRate = round($rate['Name'],2);
                }
            }
        }


        return $selectedRate;
    }
}
