<?php

namespace App\Filament\Exports\Quote\Vehicle;

use App\Models\Quote\Vehicle\QuoteVehicle;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class QuoteVehicleExporter extends Exporter
{
    protected static ?string $model = QuoteVehicle::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('quote.start_date')
                ->label('FECHA DE EMISIÓN'),

            ExportColumn::make('quote.lead.full_name')
                ->label('NOMBRE'),

            ExportColumn::make('quote.lead.identity_number')
                ->label('IDENTIFICADOR'),

            ExportColumn::make('quote.lead.birth_date')
                ->label('FECHA DE NAC'),

            ExportColumn::make('quote.lead.age')
                ->label('EDAD'),

            ExportColumn::make('quote.end_date')
                ->label('VENCIMIENTO'),

            ExportColumn::make('quote.selectedLine.name')
                ->label('ASEGURADORA'),

            ExportColumn::make('selectedLine.total_monthly')
                ->label('PRIMA COBRADA CLIENTE (INCLUYE VIDA + MARKUP)'),

            ExportColumn::make('selectedLine.amount_without_life_amount')
                ->label('PRIMA VEHICULO (SIN VIDA Y MARKUP)'),

            ExportColumn::make('selectedLine.life_amount')
                ->label('PRIMA VIDA'),

            ExportColumn::make('selectedLine.markup')
                ->label('MARKUP VEHICULO'),

            ExportColumn::make('quote.selectedLine.total')
                ->label('PRIMA A PAGAR ASEGURADORA VEH.'),

            ExportColumn::make('vehicle_amount')
                ->label('VALOR ASEGURADO'),

            ExportColumn::make('vehicle.chassis')
                ->label('CHASIS'),

            ExportColumn::make('vehicle.vehicleMake.name')
                ->label('MARCA'),

            ExportColumn::make('vehicle.vehicleModel.name')
                ->label('MODELO'),

            ExportColumn::make('vehicle.vehicle_year')
                ->label('Año'),

            ExportColumn::make('vehicle.vehicleUtility.name')
                ->label('PLAN'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your quote vehicle export has completed and '.Number::format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
