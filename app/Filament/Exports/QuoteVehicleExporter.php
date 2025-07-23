<?php

namespace App\Filament\Exports;

use App\Models\QuoteVehicle;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Filament\Actions\Exports\ExportColumn;

class QuoteVehicleExporter extends Exporter
{
    protected static ?string $model = QuoteVehicle::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('quote.start_date')
                ->label('FECHA DE EMISIÓN'),
            ExportColumn::make('quote.customer.full_name')
                ->label('NOMBRE'),
            ExportColumn::make('quote.customer.identity_number')
                ->label('IDENTIFICADOR'),
            ExportColumn::make('quote.customer.birth_date')
                ->label('FECHA DE NAC'),
            ExportColumn::make('quote.customer.birth_date')
                ->label('EDAD'),
            ExportColumn::make('end_date')
                ->label('VENCIMIENTO'),
            ExportColumn::make('quote.selectedLine.name')
                ->label('ASEGURADORA'),
            ExportColumn::make('start_date')
                ->label('PRIMA COBRADA CLIENTE (INCLUYE VIDA + MARKUP)'),
            ExportColumn::make('start_date')
                ->label('PRIMA VEHICULO (SIN VIDA Y MARKUP)'),
            ExportColumn::make('selectedLine.life_amount')
                ->label('PRIMA VIDA'),
            ExportColumn::make('start_date')
                ->label('MARKUP VEHICULO'),
            ExportColumn::make('quote.selectedLine.total')
                ->label('PRIMA A PAGAR ASEGURADORA VEH.'),
            ExportColumn::make('start_date')
                ->label('VALOR ASEGURADO'),
            ExportColumn::make('vehicleMake.name')
                ->label('MARCA'),
            ExportColumn::make('vehicleModel.name')
                ->label('MODELO'),
            ExportColumn::make('vehicle_year')
                ->label('Año'),
            ExportColumn::make('start_date')
                ->label('PLAN'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your quote vehicle export has completed and '.number_format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
