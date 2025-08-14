<?php

namespace App\Filament\CRM\Resources\Leads\Pages;

use App\Filament\CRM\Resources\Leads\LeadResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLead extends CreateRecord
{
    protected static string $resource = LeadResource::class;
}
