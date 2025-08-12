<?php

namespace Modules\CRM\Presentation\Filament\Resources\DebtorTypes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\CRM\Presentation\Filament\Resources\DebtorTypes\DebtorTypeResource;

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
