<?php

namespace Modules\Presentation\CRM\Filament\Resources\Leads\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Presentation\CRM\Filament\Resources\Leads\LeadResource;

class CreateLead extends CreateRecord
{
    protected static string $resource = LeadResource::class;
}
