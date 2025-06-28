<?php

namespace App\Livewire;

use App\Helpers\Cotizacion;
use App\Helpers\Cotizaciones;
use App\Helpers\CotizarAuto;
use App\Models\Vehicle\VehicleMake;
use App\Models\Vehicle\VehicleModel;
use App\Services\ZohoCRMService;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Livewire\Component;

class EstimateVehicleForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('marca')
                    ->label('Marca')
                    ->options(VehicleMake::pluck('name', 'id'))
                    ->searchable()
                    ->preload()
                    ->required()
                    ->live()
                    ->placeholder('Selecciona una Marca'),

                Select::make('modelo')
                    ->label('Modelo')
                    ->options(function (Get $get) {
                        $makeId = $get('marca');
                        if (! $makeId) {
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
                    ->disabled(fn (Get $get) => ! $get('marca')),

                TextInput::make('ano')
                    ->label('Año')
                    ->numeric()
                    ->required()
                    ->minValue(1900)
                    ->maxValue(date('Y', strtotime('+1 year'))),

                TextInput::make('suma')
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

                Select::make('uso')
                    ->label('Uso')
                    ->options([
                        'Privado' => 'Privado',
                        'Publico' => 'Público',
                    ])
                    ->default('Privado')
                    ->required(),

                Select::make('estado')
                    ->label('Estado')
                    ->options([
                        'Nuevo' => '0 KM',
                        'Usado' => 'Usado',
                    ])
                    ->default('Nuevo')
                    ->required(),

                Checkbox::make('salvamento')
                    ->label('Salvamento')
                    ->inline(false),

                Select::make('tipo')
                    ->label('Tipo')
                    ->options([
                        'Mensual' => 'Mensual',
                        'Anual' => 'Anual',
                    ])
                    ->default('Nuevo')
                    ->required(),
            ])
            ->statePath('data')
            ->columns();
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $libreria = new Cotizaciones;

        $cotizacion = new Cotizacion;

        $cotizacion->suma = $data['suma'];

        $cotizacion->plan = $data['plan'];
        $cotizacion->ano = $data['ano'];
        $cotizacion->uso = $data['uso'];
        $cotizacion->estado = $data['estado'];
        $cotizacion->tipo_pago = $data['tipo'];

        $criteria = 'Name:equals:'.VehicleMake::find($data['marca'])->name;
        $vehicleMake = app(ZohoCRMService::class)->searchRecords('Marcas', $criteria);

        $criteria = 'Name:equals:'.VehicleModel::find($data['modelo'])->name;
        $vehicleModel = app(ZohoCRMService::class)->searchRecords('Modelos', $criteria);

        $cotizacion->marcaid = $vehicleMake['data'][0]['id'];
        $cotizacion->modeloid = $vehicleModel['data'][0]['id'];
        $cotizacion->modelotipo = VehicleModel::find($data['modelo'])->type->name;

        $cotizacion->salvamento = $data['salvamento'];

        $cotizar = new CotizarAuto($cotizacion, $libreria);

        $cotizar->cotizar_planes();

        $this->dispatch('fill-estimate-table', $cotizacion->planes);
        $this->dispatch('fill-complete-estimate-form', json_decode(json_encode($cotizacion), true));
    }

    public function render()
    {
        return view('livewire.estimate-vehicle-form');
    }
}
