<?php

namespace Modules\CRM\Presentation\Filament\Resources\DebtorTypeResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\CRM\Presentation\Filament\Resources\DebtorTypeResource;

class ListDebtorTypes extends ListRecords
{
    protected static string $resource = DebtorTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
