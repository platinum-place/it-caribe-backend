<?php

namespace Root\CRM\Presentation\Filament\Resources\Leads\Pages;

use Filament\Resources\Pages\CreateRecord;
use Root\CRM\Presentation\Filament\Resources\Leads\LeadResource;

class CreateLead extends CreateRecord
{
    protected static string $resource = LeadResource::class;
}
