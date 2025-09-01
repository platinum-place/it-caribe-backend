<?php

namespace App\Filament\Branch\Resources\QuoteVehicles\Tables;

use App\Filament\Exports\Quote\Vehicle\QuoteVehicleExporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class QuoteVehiclesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('quote.start_date')
                    ->sortable()
                    ->label('FECHA DE EMISIÓN'),

                TextColumn::make('quote.lead.full_name')
                    ->searchable()
                    ->label('NOMBRE'),

                TextColumn::make('quote.lead.identity_number')
                    ->searchable()
                    ->label('IDENTIFICADOR'),

                TextColumn::make('quote.lead.birth_date')
                    ->label('FECHA DE NAC'),

                TextColumn::make('quote.lead.age')
                    ->label('EDAD'),

                TextColumn::make('quote.end_date')
                    ->sortable()
                    ->label('VENCIMIENTO'),

                TextColumn::make('quote.acceptedLine.name')
                    ->label('ASEGURADORA'),

                TextColumn::make('acceptedLine.total_monthly')
                    ->label('PRIMA COBRADA CLIENTE (INCLUYE VIDA + MARKUP)'),

                TextColumn::make('acceptedLine.amount_without_life_amount')
                    ->label('PRIMA VEHICULO (SIN VIDA Y MARKUP)'),

                TextColumn::make('acceptedLine.life_amount')
                    ->label('PRIMA VIDA'),

                TextColumn::make('acceptedLine.markup')
                    ->label('MARKUP VEHICULO'),

                TextColumn::make('quote.acceptedLine.total')
                    ->label('PRIMA A PAGAR ASEGURADORA VEH.'),

                TextColumn::make('vehicle_amount')
                    ->label('VALOR ASEGURADO'),

                TextColumn::make('vehicle.chassis')
                    ->label('CHASIS'),

                TextColumn::make('vehicle.vehicleMake.name')
                    ->label('MARCA'),

                TextColumn::make('vehicle.vehicleModel.name')
                    ->label('MODELO'),

                TextColumn::make('vehicle.vehicle_year')
                    ->label('Año'),

                TextColumn::make('vehicle.vehicleUtility.name')
                    ->label('PLAN'),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(QuoteVehicleExporter::class),
                ]),
            ]);
    }
}
