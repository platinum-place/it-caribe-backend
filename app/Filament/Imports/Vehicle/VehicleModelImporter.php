<?php

namespace App\Filament\Imports\Vehicle;

use App\Models\Vehicle\VehicleModel;
use App\Models\Vehicle\VehicleType;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class VehicleModelImporter extends Importer
{
    protected static ?string $model = VehicleModel::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('id')
                ->requiredMapping()
                ->exampleHeader(__('ID'))
                ->label(__('ID'))
                ->rules(['required', 'integer']),
            ImportColumn::make('make')
                ->relationship('make', 'name')
                ->requiredMapping()
                ->exampleHeader(__('Vehicle make'))
                ->label(__('Vehicle make'))
                ->rules(['required', 'exists:vehicle_makes,name']),
            ImportColumn::make('name')
                ->requiredMapping()
                ->exampleHeader(__('Vehicle model'))
                ->label(__('Vehicle model'))
                ->rules(['required', 'max:255']),
            ImportColumn::make('type')
                ->relationship('type', 'name')
                ->requiredMapping()
                ->exampleHeader(__('Vehicle type'))
                ->label(__('Vehicle type'))
                ->rules(['required', 'exists:vehicle_types,name']),
        ];
    }

    public function resolveRecord(): ?VehicleModel
    {
        return new VehicleModel();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = __('The import has been completed successfully. :rows row(s) imported', ['rows' => number_format($import->successful_rows)]);

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . __(':rows row(s) have failed to import', ['rows' => number_format($failedRowsCount)]);
        }

        return $body;
    }
}
