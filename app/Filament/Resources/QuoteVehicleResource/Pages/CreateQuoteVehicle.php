<?php

namespace App\Filament\Resources\QuoteVehicleResource\Pages;

use App\Filament\Resources\QuoteVehicleResource;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
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
                                ->live()
                                ->placeholder('Selecciona un modelo')
                                ->disabled(fn(Get $get) => !$get('marca')),

                            Actions::make([
                                Action::make('generateEstimate')
                                    ->label('Generar Cotización')
                                    ->action(function (Set $set, Get $get) {
                                        $marca = $get('marca');
                                        $modelo = $get('modelo');

                                        $results = [
                                            [
                                                'id' => 'plan_1',
                                                'plan' => 'Plan Básico',
                                                'price' => '$299.99',
                                                'coverage' => 'Cobertura Básica',
                                                'deductible' => '$500',
                                                'features' => ['Responsabilidad Civil', 'Daños Materiales', 'Asistencia 24/7'],
                                            ],
                                            [
                                                'id' => 'plan_2',
                                                'plan' => 'Plan Intermedio',
                                                'price' => '$499.99',
                                                'coverage' => 'Cobertura Amplia',
                                                'deductible' => '$300',
                                                'features' => ['Todo Riesgo', 'Robo/Hurto', 'Cristales', 'Asistencia Premium'],
                                            ],
                                            [
                                                'id' => 'plan_3',
                                                'plan' => 'Plan Premium',
                                                'price' => '$799.99',
                                                'coverage' => 'Cobertura Total',
                                                'deductible' => '$100',
                                                'features' => ['Todo Riesgo Plus', 'Vehículo de Reemplazo', 'Asistencia VIP', 'Gastos Médicos'],
                                            ],
                                            [
                                                'id' => 'plan_4',
                                                'plan' => 'Plan Familiar',
                                                'price' => '$1,199.99',
                                                'coverage' => 'Cobertura Familiar',
                                                'deductible' => '$200',
                                                'features' => ['Múltiples Vehículos', 'Protección Familiar', 'Asistencia Completa'],
                                            ],
                                        ];

                                        $set('estimate_results', $results);

                                        $repeaterData = collect($results)->map(function ($result) {
                                            return [
                                                'id' => $result['id'],
                                                'plan' => $result['plan'],
                                                'price' => $result['price'],
                                                'coverage' => $result['coverage'],
                                                'deductible' => $result['deductible'],
                                                'features' => implode(', ', $result['features']),
                                                'selected' => false,
                                            ];
                                        })->toArray();

                                        $set('selected_estimates', $repeaterData);
                                    })
                                    ->disabled(fn(Get $get) => !$get('marca') || !$get('modelo'))
                                    ->color('primary')
                                    ->icon('heroicon-o-calculator'),
                            ]),

                            Grid::make(1)
                                ->schema([
                                    Placeholder::make('results_title')
                                        ->label('')
                                        ->content('Opciones de Cotización Disponibles')
                                        ->visible(fn(Get $get) => !empty($get('estimate_results'))),

                                    Repeater::make('selected_estimates')
                                        ->schema([
                                            Grid::make(2)
                                                ->schema([
                                                    TextInput::make('plan')
                                                        ->label('Plan')
                                                        ->disabled()
                                                        ->dehydrated(false),

                                                    TextInput::make('price')
                                                        ->label('Precio')
                                                        ->disabled()
                                                        ->dehydrated(false),

                                                    TextInput::make('coverage')
                                                        ->label('Cobertura')
                                                        ->disabled()
                                                        ->dehydrated(false),

                                                    TextInput::make('deductible')
                                                        ->label('Deducible')
                                                        ->disabled()
                                                        ->dehydrated(false),
                                                ]),
                                            Hidden::make('id'),
                                        ])
                                        ->addable(false)
                                        ->deletable(false)
                                        ->reorderable(false)
                                        ->collapsed(false)
                                        ->cloneable(false)
                                        ->itemLabel(fn (array $state): ?string =>
                                        !empty($state['plan']) ? "{$state['plan']} - {$state['price']}" : null
                                        )
                                        ->visible(fn(Get $get) => !empty($get('estimate_results')))
                                        ->columnSpanFull(),
                                ])
                                ->columnSpanFull(),
                        ])
                        ->columns(),
                    Wizard\Step::make('Delivery')
                        ->schema([
                            // ...
                        ]),
                    Wizard\Step::make('Billing')
                        ->schema([
                            // ...
                        ]),
                ])
                    ->columnSpanFull(),
            ]);
    }
}
