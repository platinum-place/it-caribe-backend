<?php

namespace App\Http\Controllers\Quote\Vehicle;

use App\Http\Controllers\Controller;
use App\Http\Requests\Quote\Vehicle\EstimateVehicleRequest;
use App\Models\Vehicle\VehicleMake;
use App\Models\Vehicle\VehicleModel;
use App\Services\Quote\Vehicle\EstimateQuoteVehicleService;
use Illuminate\Http\Request;

class EstimateQuoteVehicleController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws \JsonException
     */
    public function __invoke(EstimateVehicleRequest $request)
    {
        $data = $request->all();

        $vehicleMake = VehicleMake::firstWhere('code', $data['Marca']);
        $vehicleModel = VehicleModel::firstWhere('code', $data['Modelo']);

        $lines = app(EstimateQuoteVehicleService::class)->handle(
            $data['MontoAsegurado'],
            $vehicleMake?->id,
            $vehicleModel?->id,
            $data['Anio'],
            $vehicleModel?->vehicle_type_id,
            1,
        );

        $response = [];

        foreach ($lines as $line) {
            $response[] = [
                'passcode' => null,
                'ofertaid' => null,
                'Prima' => number_format($line['amount_taxed'], 1, '.', ''),
                'Impuesto' => number_format($line['tax_amount'], 1, '.', ''),
                'PrimaTotal' => number_format($line['total'], 1, '.', ''),
                'PrimaCuota' => number_format($line['total_monthly'], 1, '.', ''),
                'Planid' => $line['description'],
                'Plan' => 'Automóvil',
                'Aseguradora' => $line['vendor_name'],
                'IdCotizacion' => (string)$line['description'],
                'Fecha' => date('d/m/Y H:i:s A'),
                'Error' => $line['error'],
                'CoberturasList' => [
                    [
                        'Cobertura' => 'Fianza judicial',
                        'Valor' => '1,000,000',
                        'Error' => null,
                    ],
                ],
            ];
        }

        $json = json_encode($response, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES);
        $json = preg_replace('/"(\w+)":\s*"(\d+\.\d)"/', '"$1": $2', $json);

        return response($json, 200)->header('Content-Type', 'application/json');
    }
}
