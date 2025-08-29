<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Unemployment\CancelUnemploymentRequest;
use App\Http\Requests\Api\Unemployment\EstimateUnemploymentRequest;
use App\Http\Requests\Api\Unemployment\IssueUnemploymentRequest;
use App\Services\Api\Zoho\ZohoCRMService;
use App\Services\EstimateQuoteUnemploymentService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class UnemploymentController
{
    public function __construct(protected ZohoCRMService $crm) {}

    /**
     * @throws ConnectionException
     * @throws RequestException
     */
    public function estimateUnemployment(EstimateUnemploymentRequest $request)
    {
        $data = $request->all();

        $estimates = app(EstimateQuoteUnemploymentService::class)->estimate(
            $data['Edad'],
            $data['MontoOriginal'],
            $data['Plazo'],
            1,
            1,
        );

        $quotes = [];

        foreach ($estimates as $estimate) {
            $quotes[] = [
                'Impuesto' => number_format($estimate['tax_amount'], 1, '.', ''),
                'identificador' => (string) $estimate['id_crm'],
                'Cliente' => $request->get('Cliente'),
                'Direccion' => $request->get('Direccion'),
                'Fecha' => now()->format('Y-m-d\TH:i:sP'),
                'TipoEmpleado' => $request->get('idTipoEmpleado'),
                'IdentCliente' => $request->get('IdentCliente'),
                'Aseguradora' => $estimate['vendor_name'],
                'MontoOriginal' => number_format($request->get('MontoOriginal'), 1, '.', ''),
                'Cuota' => number_format($request->get('Cuota'), 1, '.', ''),
                'PlazoMeses' => $request->get('Plazo'),
                'Prima' => number_format($estimate['total'], 1, '.', ''),
                'Error' => null,
            ];
        }

        $json = json_encode($quotes, JSON_UNESCAPED_SLASHES);
        $json = preg_replace('/"(\w+)":\s*"(\d+\.\d)"/', '"$1": $2', $json);

        return response($json, 200)->header('Content-Type', 'application/json');
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function issueUnemployment(IssueUnemploymentRequest $request)
    {
        $fields = ['id', 'Quoted_Items'];
        $quote = $this->crm->getRecords('Quotes', $fields, $request->get('Identificador'))['data'][0];

        foreach ($quote['Quoted_Items'] as $line) {
            $data = [
                'Coberturas' => $line['Product_Name']['id'],
                'Quote_Stage' => 'Emitida',
                'Vigencia_desde' => date('Y-m-d'),
                'Valid_Till' => date('Y-m-d', strtotime(date('Y-m-d').'+ 1 years')),
                'Prima_neta' => round($line['Net_Total'] / 1.16, 2),
                'ISC' => round($line['Net_Total'] - ($line['Net_Total'] / 1.16), 2),
                'Prima' => round($line['Net_Total'], 2),
            ];

            $this->crm->updateRecords('Quotes', $request->get('Identificador'), $data);

            break;
        }

        return response()->json(['Error' => '']);
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function cancelUnemployment(CancelUnemploymentRequest $request)
    {
        $fields = ['id', 'Plan', 'Quoted_Items'];
        $quote = $this->crm->getRecords('Quotes', $fields, $request->get('Identificador'))['data'][0];

        if ($quote['Plan'] !== 'Vida/Desempleo') {
            throw new NotFoundHttpException(__('Not Found'));
        }

        $data = [
            'Quote_Stage' => 'Cancelada',
        ];

        $this->crm->updateRecords('Quotes', $request->get('Identificador'), $data);

        return response()->json(['Error' => '']);
    }
}
