<?php

namespace App\Http\Controllers\Quote\Fire;

use App\Enums\Quote\Fire\QuoteFireRiskTypeEnum;
use App\Enums\Quote\Life\QuoteLifeCreditTypeEnum;
use App\Enums\Quote\QuoteLineStatusEnum;
use App\Enums\Quote\QuoteStatusEnum;
use App\Enums\Quote\QuoteTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Quote\Fire\EstimateFireRequest;
use App\Models\CRM\Lead;
use App\Models\Quote\Life\QuoteLife;
use App\Models\Quote\Life\QuoteLifeLine;
use App\Models\Quote\Quote;
use App\Models\Quote\QuoteLine;
use App\Services\Quote\Fire\EstimateQuoteFireService;
use App\Services\Quote\Life\EstimateQuoteLifeService;
use Illuminate\Http\Request;

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
            $data['EdadCodeudor'],
        );

        dd($lines);

        $response = \DB::transaction(static function () use ($data, $lines) {
            $lead = Lead::create([
                'full_name' => $data['NombreCliente'],
                'identity_number' => $data['IdenCliente'],
                'birth_date' => $data['FechaNacimiento'],
                'home_phone' => $data['Telefono1'],
                'lead_type_id' => 1,
            ]);

            //            if(isset($data['codeudor']) && $data['codeudor']){
            //                $coBorrower = Lead::create([
            //                    'full_name' => $data['NombreCliente'],
            //                    'identity_number' => $data['IdenCliente'],
            //                    'birth_date' => $data['FechaNacimiento'],
            //                    'home_phone' => $data['Telefono1'],
            //                    'lead_type_id' => 1,
            //                ]);
            //            }

            $quote = Quote::create([
                'quote_status_id' => QuoteStatusEnum::PENDING->value,
                'quote_type_id' => QuoteTypeEnum::LIFE->value,
                'lead_id' => $lead->id,
                'start_date' => now(),
            ]);

            $quoteLife = QuoteLife::create([
                'quote_id' => $quote->id,
                //                'co_borrower_id' => $coBorrower?->id ?? null,
                'quote_life_credit_type_id' => QuoteLifeCreditTypeEnum::PERSONAL_LOAN->value,
                'deadline_month' => $data['PlazoAnios'] * 12,
                'deadline_year' => $data['PlazoAnios'],
                'insured_amount' => $data['MontoOriginal'],
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
