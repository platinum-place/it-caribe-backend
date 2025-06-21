<?php

namespace App\Filament\Exports\Vehicle;

use App\Models\Vehicle\VehicleModel;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class VehicleModelExporter extends Exporter
{
    protected static ?string $model = VehicleModel::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('make.name')
                ->label(__('Vehicle make')),
            ExportColumn::make('name')
                ->label(__('Vehicle model')),
            ExportColumn::make('type.name')
                ->label(__('Vehicle type')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = __('The export has been completed successfully. :rows row(s) exported', ['rows' => number_format($export->successful_rows)]);

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.__(':rows row(s) have failed to export', ['rows' => number_format($failedRowsCount)]);
        }

        return $body;
    }
}
