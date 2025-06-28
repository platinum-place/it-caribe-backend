<?php

namespace App\Filament\Imports\Vehicle;

use App\Models\Vehicle\VehicleType;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class VehicleTypeImporter extends Importer
{
    protected static ?string $model = VehicleType::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->requiredMapping()
                ->exampleHeader(__('Name'))
                ->label(__('Name'))
                ->rules(['required', 'max:255']),
        ];
    }

    public function resolveRecord(): ?VehicleType
    {
        //         return VehicleType::firstOrNew([
        //             'name' => $this->data['name'],
        //         ]);

        return new VehicleType;
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
