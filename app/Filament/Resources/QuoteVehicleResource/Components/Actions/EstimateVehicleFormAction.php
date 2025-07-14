<?php

namespace App\Filament\Resources\QuoteVehicleResource\Components\Actions;

use App\Helpers\Cotizacion;
use App\Helpers\Cotizaciones;
use App\Helpers\CotizarAuto;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use App\Models\VehicleUse;
use App\Services\ZohoCRMService;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;

class EstimateVehicleFormAction
{
    public static function make()
    {
        return Grid::make()
            ->schema([
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
            ]);
    }
}
