<?php

namespace App\Http\Controllers\Quote\Fire;

use App\Http\Controllers\Controller;
use App\Http\Requests\Quote\Fire\EstimateFireRequest;
use App\Models\Quote;
use App\Models\QuoteFire;
use App\Models\QuoteLifeLine;
use App\Models\QuoteLine;
use Modules\CRM\Enums\LeadTypeEnum;
use Modules\CRM\Models\Lead;
use Modules\Quote\Enums\QuoteFireConstructionTypeEnum;
use Modules\Quote\Enums\QuoteFireCreditTypeEnum;
use Modules\Quote\Enums\QuoteFireRiskTypeEnum;
use Modules\Quote\Enums\QuoteLineStatusEnum;
use Modules\Quote\Enums\QuoteStatusEnum;
use Modules\Quote\Enums\QuoteTypeEnum;
use old\Services\Quote\Fire\EstimateQuoteFireService;

class EstimateQuoteFireController extends Controller
{
    public function __construct(protected EstimateQuoteFireService $service) {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(EstimateFireRequest $request)
    {
        $data = $request->all();

        $lines = $this->service->handle(
            $data['MontoOriginal'],
            QuoteFireRiskTypeEnum::HOUSING->value,
            30,
            $data['Plazo'],
            $data['ValorFinanciado'],
            $data['EdadCodeudor'] ?? null,
        );

        $response = \DB::transaction(static function () use ($data, $lines) {
            $lead = Lead::create([
                'full_name' => $data['Cliente'],
                'identity_number' => $data['IdentCliente'],
                'home_phone' => $data['Telefono'],
                'lead_type_id' => LeadTypeEnum::PUBLIC->value,
            ]);

            $quote = Quote::create([
                'quote_status_id' => QuoteStatusEnum::PENDING->value,
                'quote_type_id' => QuoteTypeEnum::FIRE->value,
                'lead_id' => $lead->id,
                'start_date' => date('Y-m-d', strtotime($data['FechaEmision'])),
                'end_date' => date('Y-m-d', strtotime($data['FechaVencimiento'])),
            ]);

            $quoteLife = QuoteFire::create([
                'quote_id' => $quote->id,
                'quote_fire_credit_type_id' => QuoteFireCreditTypeEnum::MORTGAGE->value,
                'quote_fire_risk_type_id' => QuoteFireRiskTypeEnum::HOUSING->value,
                'quote_fire_construction_type_id' => QuoteFireConstructionTypeEnum::SUPERIOR->value,
                'deadline_month' => $data['Plazo'] / 12,
                'deadline_year' => $data['Plazo'],
                'appraisal_value' => $data['ValorFinanciado'],
                'financed_value' => $data['MontoOriginal'],
            ]);

            $response = [];

            foreach ($lines as $line) {
                $quoteLine = QuoteLine::create([
                    'name' => $line['vendor_name'],
                    'description' => $line['description'],
                    'quote_id' => $quote->id,
                    'unit_price' => $line['unit_price'],
                    'quantity' => $line['quantity'],
                    'subtotal' => $line['subtotal'],
                    'tax_rate' => $line['tax_rate'],
                    'tax_amount' => $line['tax_amount'],
                    'total' => $line['total'],
                    'amount_taxed' => $line['amount_taxed'],
                    'quote_line_status_id' => QuoteLineStatusEnum::NOT_ACCEPTED->value,
                ]);

                $quoteLifeLine = QuoteLifeLine::create([
                    'quote_life_id' => $quoteLife->id,
                    'quote_line_id' => $quoteLine->id,
                    'borrower_amount' => $line['borrower_amount'],
                    'co_borrower_amount' => $line['co_borrower_amount'],
                    'borrower_rate' => $line['borrower_rate'],
                    'co_borrower_rate' => $line['co_borrower_rate'],
                ]);

                $response[] = [
                    'Impuesto' => number_format($line['tax_amount'], 1, '.', ''),
                    'Prima' => number_format($line['total'], 1, '.', ''),
                    'identificador' => $quoteLifeLine->id,
                    'Aseguradora' => $line['vendor_name'],
                    'MontoOrig' => number_format($data['MontoOriginal'], 1, '.', ''),
                    'Anios' => (int) $data['PlazoAnios'],
                    'EdadTerminar' => (int) $data['Edad'] + $data['PlazoAnios'],
                    'Cliente' => $data['NombreCliente'],
                    'Fecha' => date('Y-m-d\TH:i:sP'),
                    'Direccion' => $data['Direccion'],
                    'Edad' => (int) $data['Edad'],
                    'IdenCliente' => $data['IdenCliente'],
                    'Codeudor' => $data['codeudor'] ?? false,
                    'Error' => $line['error'],
                ];
            }

            return $response;
        });

        $json = json_encode($response, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES);
        $json = preg_replace('/"(\w+)":\s*"(\d+\.\d)"/', '"$1": $2', $json);

        return response($json, 200)->header('Content-Type', 'application/json');
    }
}
