<?php

namespace App\Livewire;

use App\Helpers\Cotizacion;
use App\Helpers\Cotizaciones;
use App\Helpers\CotizarAuto;
use App\Helpers\CotizarIncendio;
use App\Helpers\CotizarVida;
use App\Models\Vehicle\VehicleMake;
use App\Models\Vehicle\VehicleModel;
use App\Services\ZohoCRMService;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Livewire\Component;

class EstimateFireForm extends Component implements HasForms
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
                TextInput::make('suma')
                    ->label('Valor de la Propiedad')
                    ->numeric()
                    ->required()
                    ->prefix('$'),

                TextInput::make('prestamo')
                    ->label('Valor del Préstamo')
                    ->numeric()
                    ->required()
                    ->prefix('$'),

                TextInput::make('plazo')
                    ->label('Plazo')
                    ->numeric()
                    ->required()
                    ->minValue(1),

                Select::make('riesgo')
                    ->label('Tipo de Riesgo')
                    ->options([
                        'Vivienda' => 'Vivienda'
                    ])
                    ->default('Vivienda'),

                Select::make('construccion')
                    ->label('Tipo de Construcción')
                    ->options([
                        'Superior' => 'Superior'
                    ])
                    ->default('Superior'),

                TextInput::make('direccion')
                    ->label('Dirección')
                    ->required()
                    ->columnSpanFull(),
            ])
            ->statePath('data')
            ->columns();
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $libreria = new Cotizaciones;

        $cotizacion = new Cotizacion;

        $cotizacion->suma = $data["suma"];
        $cotizacion->plan = 'Seguro Incendio Hipotecario';
        $cotizacion->plazo = $data["plazo"];

        $cotizacion->direccion = $data['direccion'];
        $cotizacion->prestamo = $data['prestamo'];
        $cotizacion->construccion = $data['construccion'];
        $cotizacion->riesgo = $data['riesgo'];

        $cotizar = new CotizarIncendio($cotizacion, $libreria);
        $cotizar->cotizar_planes();

        $this->dispatch('fill-estimate-table', $cotizacion->planes);
        $this->dispatch('fill-complete-estimate-form', json_decode(json_encode($cotizacion), true));
    }

    public function render()
    {
        return view('livewire.estimate-fire-form');
    }
}
