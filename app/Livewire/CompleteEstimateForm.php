<?php

namespace App\Livewire;

use App\Filament\Pages\Estimate;
use App\Helpers\Zoho;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Attributes\On;
use Livewire\Component;

class CompleteEstimateForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public ?array $estimate = [];

    public bool $show = false;

    public function mount(): void
    {
        $this->form->fill();
    }

    #[On('fill-complete-estimate-form')]
    public function fillForm($estimate)
    {
        $this->estimate = $estimate;
    }

    #[On('show-complete-estimate-form')]
    public function show()
    {
        $this->show = true;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Datos del cliente')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('nombre')
                                    ->label('Nombre')
                                    ->required(),
                                TextInput::make('apellido')
                                    ->label('Apellido')
                                    ->required(),
                                TextInput::make('rnc_cedula')
                                    ->label('RNC/Cédula')
                                    ->required(),
                                DatePicker::make('fecha')
                                    ->required()
                                    ->label('Fecha de Nacimiento'),
                                TextInput::make('correo')
                                    ->label('Correo Electrónico')
                                    ->email(),
                                TextInput::make('telefono')
                                    ->label('Tel. Celular')
                                    ->tel()
                                    ->mask('999-999-9999'),
                                TextInput::make('tel_residencia')
                                    ->label('Tel. Residencial')
                                    ->tel()
                                    ->mask('999-999-9999'),
                                TextInput::make('tel_trabajo')
                                    ->label('Tel. Trabajo')
                                    ->tel()
                                    ->mask('999-999-9999'),
                                TextInput::make('direccion')
                                    ->label('Dirección')
                                    ->columnSpanFull(),
                            ]),
                    ]),

                Section::make('Datos del vehículo')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('chasis')
                                    ->label('Chasis')
                                    ->required(),
                                TextInput::make('placa')
                                    ->label('Placa'),
                                TextInput::make('color')
                                    ->label('Color'),
                            ]),
                    ])
                    ->visible(fn () => isset($this->estimate['marcaid'])),

                Section::make('Datos del Codeudor')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('nombre_codeudor')
                                    ->label('Nombre')
                                    ->required(),
                                TextInput::make('apellido_codeudor')
                                    ->label('Apellido')
                                    ->required(),
                                TextInput::make('rnc_cedula_codeudor')
                                    ->label('RNC/Cédula')
                                    ->required(),
                                TextInput::make('correo_codeudor')
                                    ->label('Correo Electrónico')
                                    ->email(),
                                TextInput::make('telefono_codeudor')
                                    ->label('Tel. Celular')
                                    ->tel()
                                    ->mask('999-999-9999'),
                                TextInput::make('tel_residencia_codeudor')
                                    ->label('Tel. Residencial')
                                    ->tel()
                                    ->mask('999-999-9999'),
                                TextInput::make('tel_trabajo_codeudor')
                                    ->label('Tel. Trabajo')
                                    ->tel()
                                    ->mask('999-999-9999'),
                                TextInput::make('direccion_codeudor')
                                    ->label('Dirección')
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->visible(fn () => isset($this->estimate['fecha_codeudor'])),
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        $data = array_merge($this->estimate, $this->form->getState());

        $planes = $data['planes'];
        $registro = [
            'Subject' => $data['nombre'].' '.$data['apellido'],
            'Valid_Till' => date('Y-m-d', strtotime(date('Y-m-d').'+ 30 days')),
            'Vigencia_desde' => date('Y-m-d'),
            'Account_Name' => 3222373000092390001,
            'Contact_Name' => 3222373000203318001,
            'Construcci_n' => $data['construccion'] ?? null,
            'Riesgo' => $data['riesgo'] ?? null,
            'Quote_Stage' => 'Cotizando',
            'Nombre' => $data['nombre'] ?? null,
            'Apellido' => $data['apellido'] ?? null,
            'Fecha_de_nacimiento' => $data['fecha'] ?? null,
            'RNC_C_dula' => $data['rnc_cedula'] ?? null,
            'Correo_electr_nico' => $data['correo'] ?? null,
            'Direcci_n' => $data['direccion'] ?? null,
            'Tel_Celular' => $data['telefono'] ?? null,
            'Tel_Residencia' => $data['tel_residencia'] ?? null,
            'Tel_Trabajo' => $data['tel_trabajo'] ?? null,
            'Plan' => $data['plan'] ?? null,
            'Tipo' => $data['tipo'] ?? null,
            'Suma_asegurada' => $data['suma'] ?? null,
            'Plazo' => $data['plazo'] ?? null,
            'Cuota' => $data['cuota'] ?? null,
            'Prestamo' => $data['prestamo'] ?? null,
            'A_o' => $data['ano'] ?? null,
            'Marca' => $data['marcaid'] ?? null,
            'Modelo' => $data['modeloid'] ?? null,
            'Uso' => $data['uso'] ?? null,
            'Tipo_veh_culo' => $data['modelotipo'] ?? null,
            'Chasis' => $data['chasis'] ?? null,
            'Color' => $data['color'] ?? null,
            'Placa' => $data['placa'] ?? null,
            'Condiciones' => $data['estado'] ?? null,
            'Nombre_codeudor' => $data['nombre_codeudor'] ?? null,
            'Apellido_codeudor' => $data['apellido_codeudor'] ?? null,
            'Tel_Celular_codeudor' => $data['telefono_codeudor'] ?? null,
            'Tel_Residencia_codeudor' => $data['tel_residencia_codeudor'] ?? null,
            'Tel_Trabajo_codeudor' => $data['tel_trabajo_codeudor'] ?? null,
            'RNC_C_dula_codeudor' => $data['rnc_cedula_codeudor'] ?? null,
            'Fecha_de_nacimiento_codeudor' => $data['fecha_codeudor'] ?? null,
            'Direcci_n_codeudor' => $data['direccion_codeudor'] ?? null,
            'Correo_electr_nico_codeudor' => $data['correo_codeudor'] ?? null,
            'Tipo_equipo' => $data['tipo_equipo'] ?? null,
            'Salvamento' => ($data['salvamento']) ? true : false,
            'Garante' => ($data['garante']) ? true : false,
            'Tipo_de_pago' => $data['tipo_pago'] ?? null,
        ];

        $libreria = new Zoho;
        $id = $libreria->createRecords('Quotes', $registro, $planes);

        $this->redirect(Estimate::getUrl(['id' => $id]));
    }

    public function render()
    {
        return view('livewire.complete-estimate-form');
    }
}
