<?php

namespace App\Filament2\Exports;

use App\Models\Quote;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class QuoteExporter extends Exporter
{
    protected static ?string $model = Quote::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('start_date')
                ->label('FECHA DE EMISIÓN'),
            ExportColumn::make('debtor.full_name')
                ->label('NOMBRE'),
            ExportColumn::make('debtor.identity_number')
                ->label('IDENTIFICADOR'),
            ExportColumn::make('debtor.birth_date')
                ->label('FECHA DE NAC'),
            ExportColumn::make('debtor.age')
                ->label('EDAD'),
            ExportColumn::make('end_date')
                ->label('VENCIMIENTO'),
            ExportColumn::make('selectedLine.name')
                ->label('ASEGURADORA'),
            ExportColumn::make('selectedLine.total')
                ->label('PRIMA COBRADA CLIENTE (INCLUYE VIDA + MARKUP)')
                ->state(function ($record): float {
                    return round($record?->selectedLine?->total / 12, 2);
                }),
            ExportColumn::make('prima_vehiculo')
                ->label('PRIMA VEHICULO (SIN VIDA Y MARKUP)')
                ->state(function ($record): float {
                    return round(($record?->selectedLine?->total / 12) - 220, 2);
                }),
            ExportColumn::make('prima_vida')
                ->label('PRIMA VIDA')
                ->state(function ($record): float {
                    return 220;
                }),
            ExportColumn::make('markup_vehiculo')
                ->label('MARKUP VEHICULO')
                ->state(function ($record): float {
                    return 0;
                }),
            ExportColumn::make('selectedLine.total')
                ->label('PRIMA A PAGAR ASEGURADORA VEH.'),
            ExportColumn::make('quoteVehicle.vehicle_amount')
                ->label('VALOR ASEGURADO'),
            ExportColumn::make('quoteVehicle.vehicle.chassis')
                ->label('CHASIS'),
            ExportColumn::make('quoteVehicle.vehicleMake.name')
                ->label('MARCA'),
            ExportColumn::make('quoteVehicle.vehicleModel.name')
                ->label('MODELO'),
            ExportColumn::make('quoteVehicle.vehicle.vehicle_year')
                ->label('Año'),
            ExportColumn::make('plan')
                ->label('PLAN')
                ->state(function ($record): string {
                    return 'Clásico';
                }),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your quote export has completed and '.number_format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
