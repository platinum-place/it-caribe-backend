<?php

namespace App\Filament\Quote\Resources\QuoteLines\Pages;

use App\Filament\Quote\Resources\QuoteLines\QuoteLineResource;
use Filament\Resources\Pages\CreateRecord;

class CreateQuoteLine extends CreateRecord
{
    protected static string $resource = QuoteLineResource::class;
}
