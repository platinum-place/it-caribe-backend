<?php

namespace App\Livewire;

use App\Helpers\Cotizacion;
use App\Helpers\Cotizaciones;
use App\Helpers\CotizarAuto;
use App\Helpers\CotizarDesempleo;
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
                    ->label('Cuota Mensual')
                    ->numeric()
                    ->required(),

                TextInput::make('plazo')
                    ->label('Plazo')
                    ->numeric()
                    ->required(),

                TextInput::make('suma')
                    ->label('Suma Asegurada')
                    ->numeric()
                    ->required(),
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

        $cotizar = new CotizarDesempleo($cotizacion, $libreria);

        $cotizar->cotizar_planes();

        $this->dispatch('fill-estimate-table', $cotizacion->planes);
        $this->dispatch('fill-complete-estimate-form', json_decode(json_encode($cotizacion), true));
    }

    public function render()
    {
        return view('livewire.estimate-unemployment-debt-form');
    }
}
