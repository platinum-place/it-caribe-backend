<?php

namespace App\Filament\Imports\Vehicle;

use App\Models\Vehicle\VehicleMake;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class VehicleMakeImporter extends Importer
{
    protected static ?string $model = VehicleMake::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('id')
                ->requiredMapping()
                ->exampleHeader(__('ID'))
                ->label(__('ID'))
                ->rules(['required', 'integer']),
            ImportColumn::make('name')
                ->requiredMapping()
                ->exampleHeader(__('Name'))
                ->label(__('Name'))
                ->rules(['required', 'max:255']),
        ];
    }

    public function resolveRecord(): ?VehicleMake
    {
        //         return VehicleMake::firstOrNew([
        //             'id' => $this->data['id'],
        //             'name' => $this->data['name'],
        //         ]);

        return new VehicleMake;
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
