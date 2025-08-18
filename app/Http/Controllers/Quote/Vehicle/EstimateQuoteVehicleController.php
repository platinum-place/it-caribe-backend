<?php

namespace App\Http\Controllers\Quote\Vehicle;

use App\Enums\Quote\QuoteLineStatusEnum;
use App\Enums\Quote\QuoteStatusEnum;
use App\Enums\Quote\QuoteTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Quote\Vehicle\EstimateQuoteVehicleRequest;
use App\Models\CRM\Lead;
use App\Models\Quote\Quote;
use App\Models\Quote\QuoteLine;
use App\Models\Quote\Vehicle\QuoteVehicle;
use App\Models\Quote\Vehicle\QuoteVehicleLine;
use App\Models\Vehicle\Vehicle;
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
    public function __invoke(EstimateQuoteVehicleRequest $request)
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
            $quoteVehicleLine = \DB::transaction(static function () use ($data, $vehicleMake, $vehicleModel, $line) {
                $lead = Lead::create([
                    'full_name' => $data['NombreCliente'],
                    'identity_number' => $data['IdCliente'],
                    'birth_date' => $data['FechaNacimiento'],
                    'home_phone' => $data['TelefResidencia'],
                    'mobile_phone' => $data['TelefMovil'],
                    'work_phone' => $data['TelefTrabajo'],
                    'email' => $data['Email'],
                    'lead_type_id' => 1,
                    'created_by' => 1,
                ]);
                $vehicle = Vehicle::create([
                    'created_by' => 1,
                    'vehicle_year' => $data['Anio'],
                    'chassis' => $data['Chasis'],
                    'license_plate' => $data['Placa'],
                    'vehicle_make_id' => $vehicleMake?->id,
                    'vehicle_model_id' => $vehicleModel?->id,
                    'vehicle_type_id' => $vehicleModel?->vehicle_type_id,
                ]);

                $quote = Quote::create([
                    'quote_status_id' => QuoteStatusEnum::PENDING->value,
                    'quote_type_id' => QuoteTypeEnum::VEHICLE->value,
                    'lead_id' => $lead->id,
                    'start_date' => now(),
                    'created_by' => 1,
                ]);

                $quoteVehicle = QuoteVehicle::create([
                    'quote_id' => $quote->id,
                    'vehicle_amount' => $data['MontoAsegurado'],
                    'vehicle_id' => $vehicle->id,
                    'created_by' => 1,
                ]);

                $line['quote_id'] = $quote->id;
                $line['created_by'] = 1;
                $line['quote_line_status_id'] = QuoteLineStatusEnum::NOT_ACCEPTED->value;
                $quoteLine = QuoteLine::create($line);

                $line['quote_vehicle_id'] = $quoteVehicle->id;
                $line['quote_line_id'] = $quoteLine->id;
                $quoteVehicleLine = QuoteVehicleLine::create($line);

                return $quoteVehicleLine;
            });

            $response[] = [
                'passcode' => null,
                'ofertaid' => null,
                'Prima' => number_format($line['amount_taxed'], 1, '.', ''),
                'Impuesto' => number_format($line['tax_amount'], 1, '.', ''),
                'PrimaTotal' => number_format($line['total'], 1, '.', ''),
                'PrimaCuota' => number_format($line['total_monthly'], 1, '.', ''),
                'Planid' => $quoteVehicleLine->id, //TODO
                'Plan' => 'Automóvil',
                'Aseguradora' => $line['vendor_name'],
                'IdCotizacion' => $quoteVehicleLine->id,
                'Fecha' => date('d/m/Y H:i:s A'),
                'Error' => $line['error'],
                'CoberturasList' => [],
            ];
        }

        $json = json_encode($response, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES);
        $json = preg_replace('/"(\w+)":\s*"(\d+\.\d)"/', '"$1": $2', $json);

        return response($json, 200)->header('Content-Type', 'application/json');
    }
}
