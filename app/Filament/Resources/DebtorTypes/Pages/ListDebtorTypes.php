<?php

namespace App\Filament\Resources\DebtorTypes\Pages;

use App\Filament\Resources\DebtorTypes\DebtorTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDebtorTypes extends ListRecords
{
    protected static string $resource = DebtorTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
