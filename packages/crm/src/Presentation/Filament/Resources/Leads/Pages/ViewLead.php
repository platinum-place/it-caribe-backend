<?php

namespace Root\CRM\Presentation\Filament\Resources\Leads\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Root\CRM\Presentation\Filament\Resources\Leads\LeadResource;

class ViewLead extends ViewRecord
{
    protected static string $resource = LeadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
