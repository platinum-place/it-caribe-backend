<?php

namespace App\Livewire;

use App\Helpers\Cotizacion;
use App\Helpers\Cotizaciones;
use App\Helpers\CotizarAuto;
use App\Helpers\CotizarDesempleo;
use App\Helpers\CotizarDesempleo2;
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

class EstimateUnemploymentDebtForm extends Component implements HasForms
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
                TextInput::make('plan')
                    ->label('Plan')
                    ->default('Vida/Desempleo')
                    ->hidden(),

                TextInput::make('deudor')
                    ->label('Fecha de Nacimiento')
                    ->type('date')
                    ->required(),

                TextInput::make('cuota')
                    ->label('Cuota prestamo')
                    ->numeric()
                    ->required(),

                TextInput::make('plazo')
                    ->label('Plazo')
                    ->numeric()
                    ->required(),

                TextInput::make('suma')
                    ->label('Monto del prestamo')
                    ->numeric()
                    ->required(),

                Select::make('tipo_pago')
                    ->label('Tipo de pago')
                    ->options([
                        'Único' => 'Único',
                        'Mensual' => 'Mensual',
                    ])
                    ->required()
                    ->placeholder('Seleccione una opción'),

                Select::make('tipo_deudor')
                    ->label('Tipo Deudor')
                    ->options([
                        'Privado' => 'Privado',
                        'Público' => 'Público',
                    ])
                    ->required()
                    ->placeholder('Seleccione una opción'),
            ])
            ->statePath('data')
            ->columns(2);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $libreria = new Cotizaciones;

        $cotizacion = new Cotizacion;

        $cotizacion->plan = 'Vida/Desempleo';
        $cotizacion->fecha_deudor = $data['deudor'];
        $cotizacion->cuota = $data['cuota'];
        $cotizacion->plazo = $data['plazo'];
        $cotizacion->suma = $data['suma'];
        $cotizacion->tipo_pago = $data['tipo_pago'];
        $cotizacion->tipo_equipo = $data['tipo_deudor'];

        $cotizar = new CotizarDesempleo2($cotizacion, $libreria);

        $cotizar->cotizar_planes();

        $this->dispatch('fill-estimate-table', $cotizacion->planes);
        $this->dispatch('fill-complete-estimate-form', json_decode(json_encode($cotizacion), true));
    }

    public function render()
    {
        return view('livewire.estimate-unemployment-debt-form');
    }
}
