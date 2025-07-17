<?php

namespace App\Filament\Resources\Quotes\QuoteVehicleResource\Pages;

use App\Enums\Quotes\QuoteLineStatus;
use App\Enums\Quotes\QuoteStatus;
use App\Enums\Quotes\QuoteType;
use App\Filament\Resources\Quotes\QuoteVehicleResource;
use App\Helpers\Zoho;
use App\Models\Customer;
use App\Models\Quotes\Quote;
use App\Models\Quotes\QuoteLine;
use App\Models\Quotes\QuoteVehicle;
use App\Models\Quotes\QuoteVehicleLine;
use App\Models\Vehicles\Vehicle;
use App\Models\Vehicles\VehicleActivity;
use App\Models\Vehicles\VehicleColor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CreateQuoteVehicle extends CreateRecord
{
    protected static string $resource = QuoteVehicleResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    QuoteVehicleResource\Components\Forms\EstimateWizardForm::make(),
                    QuoteVehicleResource\Components\Forms\CustomerWizardForm::make(),
                    QuoteVehicleResource\Components\Forms\VehicleWizardForm::make(),
                ])
                    ->columnSpanFull(),
            ]);
    }

    protected function handleRecordCreation(array $data): Model
    {
        $registro = [
            'Subject' => $data['first_name'].' '.$data['last_name'],
            'Valid_Till' => date('Y-m-d', strtotime('+30 days')),
            'Vigencia_desde' => date('Y-m-d'),
            'Account_Name' => 3222373000092390001,
            'Contact_Name' => 3222373000203318001,

            // Desde cotizacion
            'Construcci_n' => $data['cotizacion']['construccion'] ?? null,
            'Riesgo' => $data['cotizacion']['riesgo'] ?? null,
            'Quote_Stage' => 'Cotizando',

            // Datos personales desde $data
            'Nombre' => $data['first_name'] ?? null,
            'Apellido' => $data['last_name'] ?? null,
            'Fecha_de_nacimiento' => $data['birth_date'] ?? null,
            'RNC_C_dula' => $data['identity_number'] ?? null,
            'Correo_electr_nico' => $data['correo'] ?? null,
            'Direcci_n' => $data['address'] ?? $data['cotizacion']['direccion'] ?? null,
            'Tel_Celular' => $data['mobile_phone'] ?? null,
            'Tel_Residencia' => $data['home_phone'] ?? null,
            'Tel_Trabajo' => $data['work_phone'] ?? null,

            // Vehículo desde cotizacion
            'Plan' => $data['cotizacion']['plan'] ?? null,
            'Tipo' => $data['tipo'] ?? $data['cotizacion']['tipo_pago'] ?? null,
            'Suma_asegurada' => $data['cotizacion']['suma'] ?? null,
            'Plazo' => $data['cotizacion']['plazo'] ?? null,
            'Cuota' => $data['cotizacion']['cuota'] ?? null,
            'Prestamo' => $data['cotizacion']['prestamo'] ?? null,
            'A_o' => $data['cotizacion']['year'] ?? null,
            'Marca' => $data['cotizacion']['marcaid'] ?? null,
            'Modelo' => $data['cotizacion']['modeloid'] ?? null,
            'Uso' => $data['cotizacion']['uso'] ?? null,
            'Tipo_veh_culo' => $data['cotizacion']['modelotipo'] ?? null,

            // Vehículo desde $data directamente
            'Chasis' => $data['chassis'] ?? null,
            'Color' => $data['color'] ?? null,
            'Placa' => $data['license_plate'] ?? null,

            // Más datos de cotización
            'Condiciones' => $data['cotizacion']['estado'] ?? null,
            'Tipo_equipo' => $data['cotizacion']['tipo_equipo'] ?? null,
            'Salvamento' => (bool) ($data['cotizacion']['salvamento'] ?? false),
            'Tipo_de_pago' => $data['cotizacion']['tipo_pago'] ?? null,
        ];

        $libreria = new Zoho;
        $id = $libreria->createRecords('Quotes', $registro, $data['cotizacion']['planes']);

        $crm = $libreria->getRecord('Quotes', $id);

        return DB::transaction(function () use ($id, $crm, $data) {
            $customer = Customer::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'identity_number' => $data['identity_number'],
                'birth_date' => $data['birth_date'] ?? null,
                'home_phone' => $data['home_phone'] ?? null,
                'mobile_phone' => $data['mobile_phone'] ?? null,
                'work_phone' => $data['work_phone'] ?? null,
                'email' => $data['email'] ?? null,
                'address' => $data['address'] ?? null,
            ]);
            $vehicle = Vehicle::create([
                'vehicle_year' => $data['vehicle_year'],
                'chassis' => $data['chassis'],
                'license_plate' => $data['license_plate'],
                'vehicle_make_id' => $data['vehicle_make_id'],
                'vehicle_model_id' => $data['vehicle_model_id'],
                'vehicle_type_id' => $data['vehicle_type_id'],
            ]);
            $vehicle->colors()->attach($data['vehicle_colors']);
            $quote = Quote::create([
                'quote_type_id' => QuoteType::VEHICLE->value,
                'quote_status_id' => QuoteStatus::PENDING->value,
                'start_date' => now(),
                'end_date' => now()->addDays(30),
                'id_crm' => $id,
                'customer_id' => $customer->id,
                'user_id' => auth()->id(),
            ]);
            $quoteVehicle = QuoteVehicle::create([
                'quote_id' => $quote->id,
                'vehicle_id' => $vehicle->id,
                'vehicle_make_id' => $data['vehicle_make_id'],
                'vehicle_year' => $data['vehicle_year'],
                'vehicle_model_id' => $data['vehicle_model_id'],
                'vehicle_type_id' => $data['vehicle_type_id'],
                'vehicle_use_id' => $data['vehicle_use_id'],
                'vehicle_activity_id' => $data['vehicle_activity_id'],
                'vehicle_amount' => $data['vehicle_amount'],
            ]);

            foreach ($crm->getLineItems() as $lineItem) {
                $quoteLine = QuoteLine::create([
                    'name' => $lineItem->getProduct()->getLookupLabel(),
                    'unit_price' => $lineItem->getNetTotal(),
                    'quantity' => 1,
                    'subtotal' => $lineItem->getNetTotal(),
                    'amount_taxed' => $lineItem->getNetTotal() / 1.16,
                    'tax_rate' => 16,
                    'tax_amount' => ($lineItem->getNetTotal() - $lineItem->getNetTotal()) / 1.16,
                    'total' => $lineItem->getNetTotal(),
                    'quote_id' => $quote->id,
                    'id_crm' => $lineItem->getProduct()->getEntityId(),
                    'quote_line_status_id' => QuoteLineStatus::NOT_ACCEPTED->value,
                ]);
                $quoteVehicleLine = QuoteVehicleLine::create([
                    'quote_vehicle_id' => $quoteVehicle->id,
                    'quote_line_id' => $quoteLine->id,
                    'life_amount' => 220,
                ]);
            }

            return $quoteVehicle;
        });
    }
}
