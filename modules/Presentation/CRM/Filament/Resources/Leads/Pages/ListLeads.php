<?php

namespace Modules\Presentation\CRM\Filament\Resources\Leads\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Presentation\CRM\Filament\Resources\Leads\LeadResource;

class ListLeads extends ListRecords
{
    protected static string $resource = LeadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
