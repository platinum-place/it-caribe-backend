<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Quote\CancelVehicleRequest;
use App\Http\Requests\Api\Quote\EstimateVehicleRequest;
use App\Http\Requests\Api\Quote\IssueVehicleRequest;
use App\Models\TmpVendorProduct;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use App\Services\Api\Zoho\ZohoCRMService;
use App\Services\EstimateQuoteVehicleService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Throwable;

class VehicleQuoteController extends Controller
{
    public function __construct(protected ZohoCRMService $crm)
    {
    }

    /**
     * @throws RequestException
     * @throws Throwable
     * @throws ConnectionException
     */
    public function estimateVehicle(EstimateVehicleRequest $request)
    {
        $vehicleMake = VehicleMake::where('code', $request->get('Marca'))->firstOrFail();
        $vehicleModel = VehicleModel::where('code', $request->get('Modelo'))->firstOrFail();

        $estimates = app(EstimateQuoteVehicleService::class)->estimate(
            $request->get('MontoAsegurado'),
            $vehicleMake->id,
            $vehicleModel->id,
            $request->get('Anio'),
            $vehicleModel->vehicle_type_id,
        );

        $response = [];

        foreach ($estimates as $estimate) {
            $response[] = [
                'passcode' => null,
                'ofertaid' => null,
                'Prima' => number_format($estimate['amount_taxed'], 1, '.', ''),
                'Impuesto' => number_format($estimate['tax_amount'], 1, '.', ''),
                'PrimaTotal' => number_format($estimate['total'], 1, '.', ''),
                'PrimaCuota' => number_format($estimate['total_monthly'], 1, '.', ''),
                'Planid' => $estimate['id_crm'],
                'Plan' => 'Plan Mensual Full',
                'Aseguradora' => $estimate['id_crm'],
                //'IdCotizacion' => (string) $responseProduct['data'][0]['details']['id'],
                'Fecha' => date('d/m/Y H:i:s A'),
                'Error' => $estimate['error'],
                'CoberturasList' => [
                    [
                        'Cobertura' => 'Fianza judicial',
                        'Valor' => '1,000,000',
                        'Error' => null,
                    ],
                ],
            ];
        }

        $json = json_encode($response, JSON_UNESCAPED_SLASHES);
        $json = preg_replace('/"(\w+)":\s*"(\d+\.\d)"/', '"$1": $2', $json);

        return response($json, 200)->header('Content-Type', 'application/json');
    }

    /**
     * @throws RequestException
     * @throws Throwable
     * @throws ConnectionException
     */
    public function issueVehicle(IssueVehicleRequest $request)
    {
        $fields = ['id', 'Quoted_Items'];
        $quote = $this->crm->getRecords('Quotes', $fields, $request->get('cotzid'))['data'][0];

        foreach ($quote['Quoted_Items'] as $line) {
            $data = [
                'Coberturas' => $line['Product_Name']['id'],
                'Quote_Stage' => 'Emitida',
                'Vigencia_desde' => date('Y-m-d'),
                'Valid_Till' => date('Y-m-d', strtotime(date('Y-m-d') . '+ 1 years')),
                'Prima_neta' => round($line['Net_Total'] / 1.16, 2),
                'ISC' => round($line['Net_Total'] - ($line['Net_Total'] / 1.16), 2),
                'Prima' => round($line['Net_Total'], 2),
            ];

            $this->crm->updateRecords('Quotes', $request->get('cotzid'), $data);

            break;
        }

        return response()->json(['Error' => '']);
    }

    public function cancelVehicle(CancelVehicleRequest $request)
    {
        $fields = ['id', 'Quoted_Items'];
        $quote = $this->crm->getRecords('Quotes', $fields, $request->get('IdCotizacion'))['data'][0];

        $data = [
            'Quote_Stage' => 'Cancelada',
        ];

        $this->crm->updateRecords('Quotes', $request->get('IdCotizacion'), $data);

        return response()->json(['Error' => '']);
    }
}
