<?php

namespace App\Filament\Forms\Components\Wizards\Lead\Create;

class CreateLeadStep
{
    public static function make(): array
    {
        return [
            CreateStep::make(),
            CreateContactStep::make(),
        ];
    }
}
