<?php

namespace Root\CRM\Presentation\Filament\Resources\LeadTypes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Root\CRM\Presentation\Filament\Resources\LeadTypes\LeadTypeResource;

class ListLeadTypes extends ListRecords
{
    protected static string $resource = LeadTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
