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
use old\Services\Quote\Vehicle\EstimateQuoteVehicleService;

class EstimateQuoteVehicleController extends Controller
{
    public function __construct(protected EstimateQuoteVehicleService $service) {}

    /**
     * Handle the incoming request.
     *
     * @throws \JsonException
     */
    public function __invoke(EstimateQuoteVehicleRequest $request)
    {
        $data = $request->all();

        $vehicleMake = VehicleMake::firstWhere('code', $data['Marca']);
        $vehicleModel = VehicleModel::firstWhere('code', $data['Modelo']);

        $lines = $this->service->handle(
            $data['MontoAsegurado'],
            $vehicleMake?->id,
            $vehicleModel?->id,
            $data['Anio'],
            1,
        );

        $response = \DB::transaction(static function () use ($data, $vehicleMake, $vehicleModel, $lines) {
            $lead = Lead::create([
                'full_name' => $data['NombreCliente'],
                'identity_number' => $data['IdCliente'],
                'birth_date' => $data['FechaNacimiento'],
                'home_phone' => $data['TelefResidencia'],
                'mobile_phone' => $data['TelefMovil'],
                'work_phone' => $data['TelefTrabajo'],
                'email' => $data['Email'],
                'lead_type_id' => 1,
            ]);

            $vehicle = Vehicle::create([
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
            ]);

            $quoteVehicle = QuoteVehicle::create([
                'quote_id' => $quote->id,
                'vehicle_amount' => $data['MontoAsegurado'],
                'vehicle_id' => $vehicle->id,
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

                $quoteVehicleLine = QuoteVehicleLine::create([
                    'quote_vehicle_id' => $quoteVehicle->id,
                    'quote_line_id' => $quoteLine->id,
                    'life_amount' => $line['life_amount'],
                    'vehicle_rate' => $line['vehicle_rate'],
                    'total_monthly' => $line['total_monthly'],
                    'latest_expenses' => $line['latest_expenses'],
                    'markup' => $line['markup'],
                    'amount_without_life_amount' => $line['amount_without_life_amount'],
                ]);

                $response[] = [
                    'passcode' => null,
                    'ofertaid' => null,
                    'Prima' => number_format($line['amount_taxed'], 1, '.', ''),
                    'Impuesto' => number_format($line['tax_amount'], 1, '.', ''),
                    'PrimaTotal' => number_format($line['total'], 1, '.', ''),
                    'PrimaCuota' => number_format($line['total_monthly'], 1, '.', ''),
                    'Planid' => $quoteVehicleLine->id, // TODO
                    'Plan' => 'Automóvil',
                    'Aseguradora' => $line['vendor_name'],
                    'IdCotizacion' => $quoteVehicleLine->id,
                    'Fecha' => date('d/m/Y H:i:s A'),
                    'Error' => $line['error'],
                    'CoberturasList' => [],
                ];
            }

            return $response;
        });

        $json = json_encode($response, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES);
        $json = preg_replace('/"(\w+)":\s*"(\d+\.\d)"/', '"$1": $2', $json);

        return response($json, 200)->header('Content-Type', 'application/json');
    }
}
