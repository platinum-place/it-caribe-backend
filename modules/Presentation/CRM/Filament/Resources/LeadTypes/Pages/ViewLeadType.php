<?php

namespace Modules\Presentation\CRM\Filament\Resources\LeadTypes\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Modules\Presentation\CRM\Filament\Resources\LeadTypes\LeadTypeResource;

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
