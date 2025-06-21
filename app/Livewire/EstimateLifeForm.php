<?php

namespace App\Livewire;

use App\Helpers\Cotizacion;
use App\Helpers\Cotizaciones;
use App\Helpers\CotizarIncendio;
use App\Helpers\CotizarVida;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class EstimateLifeForm extends Component implements HasForms
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
                DatePicker::make('deudor')
                    ->label('Fecha de Nacimiento Deudor')
                    ->required()
                    ->maxDate(now())
                    ->columns(1),

                DatePicker::make('codeudor')
                    ->label('Fecha de Nacimiento Codeudor (Si aplica)')
                    ->maxDate(now())
                    ->columns(1),

                TextInput::make('plazo')
                    ->label('Plazo')
                    ->numeric()
                    ->required()
                    ->minValue(1),

                TextInput::make('suma')
                    ->label('Suma Asegurada')
                    ->numeric()
                    ->required()
                    ->prefix('$'),

                Checkbox::make('garante')
                    ->label('Garante')
                    ->inline(false),

                Select::make('tipo_pago')
                    ->label('Tipo de pago')
                    ->options([
                        'Línea de Crédito' => 'Línea de Crédito',
                        'Préstamo Personal' => 'Préstamo Personal',
                    ])
                    ->required()
                    ->placeholder('Seleccione una opción'),

                TextInput::make('plan')
                    ->default('Vida')
                    ->hidden(),
            ])
            ->statePath('data')
            ->columns(2);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $libreria = new Cotizaciones;

        $cotizacion = new Cotizacion;

        $cotizacion->suma = $data["suma"];
        $cotizacion->plan = 'Vida';
        $cotizacion->plazo = $data["plazo"];
        $cotizacion->fecha_deudor = $data["deudor"];

        $cotizacion->fecha_codeudor = $data["codeudor"];
        $cotizacion->garante = $data["garante"];
        $cotizacion->tipo_pago = $data["tipo_pago"];

        $cotizar = new CotizarVida($cotizacion, $libreria);

        $cotizar->cotizar_planes();

        $this->dispatch('fill-estimate-table', $cotizacion->planes);
        $this->dispatch('fill-complete-estimate-form', json_decode(json_encode($cotizacion), true));
    }

    public function render()
    {
        return view('livewire.estimate-life-form');
    }
}
