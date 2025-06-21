<?php

namespace App\Filament\Imports\Vehicle;

use App\Models\Vehicle\VehicleModel;
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
                ->relationship(resolveUsing: ['id', 'name'])
                ->requiredMapping()
                ->numeric()
                ->exampleHeader(__('Vehicle make'))
                ->label(__('Vehicle make'))
                ->rules(['required']),
            ImportColumn::make('name')
                ->requiredMapping()
                ->exampleHeader(__('Vehicle model'))
                ->label(__('Vehicle model'))
                ->rules(['required', 'max:255']),
            //            ImportColumn::make('type')
            //                ->relationship(resolveUsing: ['id', 'name'])
            //                ->requiredMapping()
            //                ->numeric()
            //                ->exampleHeader(__('Vehicle type'))
            //                ->label(__('Vehicle type'))
            //                ->rules(['required', 'string']),
        ];
    }

    public function resolveRecord(): ?VehicleModel
    {
        //         return VehicleModel::firstOrNew([
        //             'vehicle_make_id' => $this->data['make'],
        //             'name' => $this->data['name'],
        //            // 'vehicle_type_id' => $this->data['type'],
        //         ]);

        return new VehicleModel(['vehicle_type_id' => 1]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = __('The import has been completed successfully. :rows row(s) imported', ['rows' => number_format($import->successful_rows)]);

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.__(':rows row(s) have failed to import', ['rows' => number_format($failedRowsCount)]);
        }

        return $body;
    }
}
