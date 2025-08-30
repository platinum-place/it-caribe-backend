<?php

namespace App\Filament\Resources\CRM\Leads\Pages;

use old\Filament\Resources\CRM\Leads\LeadResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLead extends CreateRecord
{
    protected static string $resource = LeadResource::class;
}
