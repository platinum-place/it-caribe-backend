<?php

namespace Root\CRM\Presentation\Filament\Resources\LeadTypes\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Root\CRM\Presentation\Filament\Resources\LeadTypes\LeadTypeResource;

class ViewLeadType extends ViewRecord
{
    protected static string $resource = LeadTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
