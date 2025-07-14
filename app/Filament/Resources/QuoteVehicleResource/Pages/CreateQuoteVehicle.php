<?php

namespace App\Filament\Resources\QuoteVehicleResource\Pages;

use App\Enums\QuoteStatus;
use App\Enums\QuoteType;
use App\Filament\Resources\QuoteVehicleResource;
use App\Helpers\Cotizacion;
use App\Helpers\Cotizaciones;
use App\Helpers\CotizarAuto;
use App\Helpers\Zoho;
use App\Models\Customer;
use App\Models\Quote;
use App\Models\Vehicle;
use App\Models\VehicleActivity;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use App\Models\VehicleUse;
use App\Services\ZohoCRMService;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
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
                    Wizard\Step::make(__('Estimate'))
                        ->schema([
                            Select::make('vehicle_make_id')
                                ->label('Marca')
                                ->options(VehicleMake::pluck('name', 'id'))
                                ->searchable()
                                ->preload()
                                ->required()
                                ->live()
                                ->placeholder('Selecciona una Marca'),

                            Select::make('vehicle_model_id')
                                ->label('Modelo')
                                ->options(function (Get $get) {
                                    $makeId = $get('vehicle_make_id');
                                    if (!$makeId) {
                                        return [];
                                    }

                                    return VehicleModel::with('type')
                                        ->where('vehicle_make_id', $makeId)
                                        ->get()
                                        ->mapWithKeys(function ($model) {
                                            $label = $model->name . ($model->type ? ' (' . $model->type->name . ')' : '');

                                            return [$model->id => $label];
                                        });
                                })
                                ->searchable()
                                ->required()
                                ->placeholder('Selecciona un modelo')
                                ->disabled(fn(Get $get) => !$get('vehicle_make_id')),

                            TextInput::make('year')
                                ->label('Año')
                                ->numeric()
                                ->required()
                                ->minValue(1900)
                                ->maxValue(date('Y', strtotime('+1 year'))),

                            TextInput::make('vehicle_amount')
                                ->label('Suma Asegurada')
                                ->numeric()
                                ->required()
                                ->prefix('$'),

                            Select::make('plan')
                                ->label('Plan')
                                ->options([
                                    'Full' => 'Full',
                                    'Ley' => 'Ley',
                                    'Econo' => 'Econo',
                                    'Premier' => '0 KM',
                                    'Eléctrico/Híbrido' => 'Eléctrico/Híbrido',
                                    'Empleado' => 'Empleado',
                                ])
                                ->default('Mensual full')
                                ->required(),

                            Select::make('vehicle_use_id')
                                ->label('Uso')
                                ->options(VehicleUse::pluck('name', 'id'))
                                ->required(),

                            Select::make('estado')
                                ->label('Estado')
                                ->options([
                                    'Nuevo' => '0 KM',
                                    'Usado' => 'Usado',
                                ])
                                ->default('Nuevo')
                                ->required(),

                            Select::make('tipo')
                                ->label('Tipo')
                                ->options([
                                    'Mensual' => 'Mensual',
                                    'Anual' => 'Anual',
                                ])
                                ->default('Mensual')
                                ->required(),

                            Select::make('tipo_equipo')
                                ->label('Tipo de motor')
                                ->options([
                                    '4 cilindros' => '4 cilindros',
                                    '6 cilindros' => '6 cilindros',
                                ]),

                            Actions::make([
                                Action::make('generateEstimate')
                                    ->label('Generar Cotización')
                                    ->action(function (Set $set, Get $get) {
                                        $libreria = new Cotizaciones;

                                        $cotizacion = new Cotizacion;

                                        $cotizacion->suma = $get('vehicle_amount');

                                        $cotizacion->plan = $get('plan');
                                        $cotizacion->ano = $get('year');
                                        $cotizacion->uso = VehicleUse::find($get('vehicle_use_id'))->description;
                                        $cotizacion->estado = $get('estado');
                                        $cotizacion->tipo_pago = $get('tipo');
                                        $cotizacion->tipo_equipo = $get('tipo_equipo');

                                        $model = VehicleModel::find($get('vehicle_model_id'));

                                        $criteria = 'Name:equals:' . VehicleMake::find($get('vehicle_make_id'))->name;
                                        $vehicleMake = app(ZohoCRMService::class)->searchRecords('Marcas', $criteria);

                                        $criteria = 'Name:equals:' . $model->name;
                                        $vehicleModel = app(ZohoCRMService::class)->searchRecords('Modelos', $criteria);

                                        $cotizacion->marcaid = $vehicleMake['data'][0]['id'];
                                        $cotizacion->modeloid = $vehicleModel['data'][0]['id'];
                                        $cotizacion->modelotipo = $model->type->name;

                                        $cotizar = new CotizarAuto($cotizacion, $libreria);

                                        $cotizar->cotizar_planes();

                                        $results = $cotizacion->planes;

                                        $set('planes', $results);
                                        $set('vehicle_type_id', $model->vehicle_type_id);
                                        $set('cotizacion', json_decode(json_encode($cotizacion), true));
                                    })
                                    ->color('primary')
                                    ->icon('heroicon-o-calculator'),
                            ])
                            ->columnSpanFull(),

                            Repeater::make('planes')
                                ->hiddenLabel()
                                ->schema([
                                    TextInput::make('aseguradora')
                                        ->label('Aseguradora')
                                        ->disabled()
                                        ->dehydrated(false),

                                    TextInput::make('total')
                                        ->label('Total')
                                        ->disabled()
                                        ->dehydrated(false),

                                    TextInput::make('comentario')
                                        ->label('Comentario')
                                        ->disabled()
                                        ->dehydrated(false),
                                ])
                                ->columns(3)
                                ->deletable(false)
                                ->reorderable(false)
                                ->addable(false)
                                ->columnSpanFull(),

                            Hidden::make('cotizacion'),
                            Hidden::make('vehicle_type_id'),
                        ])
                        ->columns(),
                    Wizard\Step::make('Datos del cliente')
                        ->schema([
                            TextInput::make('first_name')
                                ->label('Nombre')
                                ->required(),
                            TextInput::make('last_name')
                                ->label('Apellido')
                                ->required(),
                            TextInput::make('identity_number')
                                ->label('RNC/Cédula')
                                ->required(),
                            DatePicker::make('birth_date')
                                ->required()
                                ->label('Fecha de Nacimiento'),
                            TextInput::make('correo')
                                ->label('Correo Electrónico')
                                ->email(),
                            TextInput::make('mobile_phone')
                                ->label('Tel. Celular')
                                ->tel()
                                ->mask('999-999-9999'),
                            TextInput::make('home_phone')
                                ->label('Tel. Residencial')
                                ->tel()
                                ->mask('999-999-9999'),
                            TextInput::make('work_phone')
                                ->label('Tel. Trabajo')
                                ->tel()
                                ->mask('999-999-9999'),
                            TextInput::make('address')
                                ->label('Dirección')
                                ->columnSpanFull(),
                        ])
                        ->columns(),
                    Wizard\Step::make('Datos del vehículo')
                        ->schema([
                            TextInput::make('chassis')
                                ->label('Chasis')
                                ->required(),
                            TextInput::make('license_plate')
                                ->label('Placa'),
                            TextInput::make('color')
                                ->label('Color'),
                            Select::make('vehicle_activity_id')
                                ->label('Actividad del Vehículo')
                                ->options(VehicleActivity::pluck('name', 'id'))
                                ->default(1)
                                ->required(),
                        ])
                        ->columns(),
                ])
                    ->columnSpanFull(),
            ]);
    }

    protected function handleRecordCreation(array $data): Model
    {
        $registro = [
            'Subject' => $data['first_name'] . ' ' . $data['last_name'],
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
            'Salvamento' => (bool)($data['cotizacion']['salvamento'] ?? false),
            'Tipo_de_pago' => $data['cotizacion']['tipo_pago'] ?? null,
        ];

        $libreria = new Zoho;
        $id = $libreria->createRecords('Quotes', $registro, $data['cotizacion']['planes']);

        return DB::transaction(function () use ($id, $data) {
            $quote = Quote::create([
                'quote_type_id' => QuoteType::VEHICLE->value,
                'quote_status_id' => QuoteStatus::PENDING->value,
                'start_date' => now(),
                'end_date' => now()->addDays(30),
                'id_crm' => $id,
                'customer_id' => Customer::create($data)->id
            ]);

            $data['vehicle_id'] = Vehicle::create($data)->id;
            $quoteVehicle = $quote->quoteVehicle()->create($data);

            foreach ($data['cotizacion']['planes'] as $plan) {
                $quote->lines()->create([
                    'name' => $plan['aseguradora'],
                    'unit_price' => $plan['prima'],
                    'quantity' => 1,
                    'subtotal' => $plan['prima'],
                    'amount_taxed' => $plan['prima'],
                    'tax_rate' => 16,
                    'tax_amount' => $plan['neta'],
                    'total' => $plan['total'],
                ]);

                $quoteVehicle->lines()->create([
                    'name' => $plan['aseguradora'],
                    'unit_price' => $plan['prima'],
                    'quantity' => 1,
                    'subtotal' => $plan['prima'],
                    'amount_taxed' => $plan['prima'],
                    'tax_rate' => 16,
                    'tax_amount' => $plan['neta'],
                    'total' => $plan['total'],
                    'life_amount' => 220,
                ]);
            }

            return $quoteVehicle;
        });
    }
}
