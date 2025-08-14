<?php

namespace App\Filament\Resources\DebtorTypes\Pages;

use App\Filament\Resources\DebtorTypes\DebtorTypeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDebtorType extends ViewRecord
{
    protected static string $resource = DebtorTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
