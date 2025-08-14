<?php

namespace App\Filament\Resources\QuoteTypes\Pages;

use App\Filament\Resources\QuoteTypes\QuoteTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateQuoteType extends CreateRecord
{
    protected static string $resource = QuoteTypeResource::class;
}
