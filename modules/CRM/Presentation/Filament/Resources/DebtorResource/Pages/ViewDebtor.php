<?php

namespace Modules\CRM\Presentation\Filament\Resources\DebtorResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Modules\CRM\Presentation\Filament\Resources\DebtorResource;

class ViewDebtor extends ViewRecord
{
    protected static string $resource = DebtorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
