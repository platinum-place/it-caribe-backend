<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Quote\CancelVehicleRequest;
use App\Http\Requests\Api\Quote\EstimateVehicleRequest;
use App\Http\Requests\Api\Quote\IssueVehicleRequest;
use App\Models\Vehicle\VehicleMake;
use App\Models\Vehicle\VehicleModel;
use App\Services\Api\Zoho\ZohoCRMService;
use App\Services\EstimateQuoteVehicleService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\DB;
use Throwable;

class VehicleQuoteController extends Controller
{
    public function __construct(protected ZohoCRMService $crm) {}

    /**
     * @throws RequestException
     * @throws Throwable
     * @throws ConnectionException
     */
    public function estimateVehicle(EstimateVehicleRequest $request)
    {
        $data = $request->all();

        $response = DB::transaction(static function () use ($data) {
            $vehicleMake = VehicleMake::where('code', $data['Marca'])->firstOrFail();
            $vehicleModel = VehicleModel::where('code', $data['Modelo'])->firstOrFail();

            $estimates = app(EstimateQuoteVehicleService::class)->estimate(
                $data['MontoAsegurado'],
                $vehicleMake->id,
                $vehicleModel->id,
                $data['Anio'],
                $vehicleModel->vehicle_type_id,
            );
            //
            //            $debtor = Debtor::create([
            //                'first_name' => $data['NombreCliente'],
            // //                'last_name' => $data['last_name'],
            //                'identity_number' => $data['IdCliente'],
            //                'birth_date' => $data['FechaNacimiento'],
            //                'home_phone' => $data['TelefResidencia'],
            //                'mobile_phone' => $data['TelefMovil'],
            //                'work_phone' => $data['TelefTrabajo'],
            //                'email' => $data['Email'],
            // //                'address' => $data['address'] ,
            //                'age' => Carbon::parse($data['FechaNacimiento'])->age,
            //            ]);
            //            $quote = Quote::create([
            //                'quote_type_id' => QuoteType::VEHICLE->value,
            //                'quote_status_id' => QuoteStatus::PENDING->value,
            //                'start_date' => $data['start_date'] ?? now(),
            //                'end_date' => $data['end_date'] ?? now()->addDays(30),
            //                'debtor_id' => $debtor->id,
            // //                'user_id' => auth()->id(),
            //            ]);
            //            $vehicle = Vehicle::create([
            //                'vehicle_year' => $data['vehicle_year'],
            //                'chassis' => $data['chassis'],
            //                'license_plate' => $data['license_plate'],
            //                'vehicle_make_id' => $data['vehicle_make_id'],
            //                'vehicle_model_id' => $data['vehicle_model_id'],
            //                'vehicle_type_id' => $data['vehicle_type_id'],
            //            ]);
            //            $quoteVehicle = QuoteVehicle::create([
            //                'quote_id' => $quote->id,
            //                'vehicle_id' => $vehicle->id,
            //                'vehicle_make_id' => $data['vehicle_make_id'],
            //                'vehicle_year' => $data['vehicle_year'],
            //                'vehicle_model_id' => $data['vehicle_model_id'],
            //                'vehicle_type_id' => $data['vehicle_type_id'],
            //                'vehicle_use_id' => $data['vehicle_use_id'],
            //                'vehicle_activity_id' => $data['vehicle_activity_id'],
            //                'vehicle_amount' => $data['vehicle_amount'],
            //                'vehicle_loan_type_id' => $data['vehicle_loan_type_id'],
            //                'is_employee' => $data['is_employee'],
            //                'leasing' => $data['leasing'],
            //                'loan_amount' => $data['loan_amount'],
            //            ]);
            //            $vehicle->colors()->attach($data['vehicle_colors']);
            //            $quoteVehicle->vehicleColors()->attach($data['vehicle_colors']);

            $response = [];

            foreach ($estimates as $estimate) {
                //                $quoteLine = QuoteLine::create([
                //                    'name' => $estimate['name'],
                //                    'unit_price' => $estimate['unit_price'],
                //                    'quantity' => $estimate['quantity'],
                //                    'subtotal' => $estimate['subtotal'],
                //                    'amount_taxed' => $estimate['amount_taxed'],
                //                    'tax_rate' => $estimate['tax_rate'],
                //                    'tax_amount' => $estimate['tax_amount'],
                //                    'total' => $estimate['total'],
                //                    'quote_id' => $quote->id,
                //                    'id_crm' => $estimate['id_crm'],
                //                    'quote_line_status_id' => QuoteLineStatus::NOT_ACCEPTED->value,
                //                ]);
                //                $quoteVehicleLine = QuoteVehicleLine::create([
                //                    'quote_vehicle_id' => $quoteVehicle->id,
                //                    'quote_line_id' => $quoteLine->id,
                //                    'life_amount' => $estimate['life_amount'],
                //                ]);

                $response[] = [
                    'passcode' => null,
                    'ofertaid' => null,
                    'Prima' => number_format($estimate['amount_taxed'], 1, '.', ''),
                    'Impuesto' => number_format($estimate['tax_amount'], 1, '.', ''),
                    'PrimaTotal' => number_format($estimate['total'], 1, '.', ''),
                    'PrimaCuota' => number_format($estimate['total_monthly'], 1, '.', ''),
                    'Planid' => $estimate['id_crm'],
                    'Plan' => 'Automóvil',
                    'Aseguradora' => $estimate['vendor_name'],
                    'IdCotizacion' => (string) $estimate['id_crm'],
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

            return $response;
        });

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
                'Valid_Till' => date('Y-m-d', strtotime(date('Y-m-d').'+ 1 years')),
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
