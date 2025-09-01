<?php

namespace App\Filament\Branch\Resources\QuoteVehicles\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class QuoteVehicleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('deleted_at')
                    ->dateTime(),
                TextEntry::make('created_by')
                    ->numeric(),
                TextEntry::make('updated_by')
                    ->numeric(),
                TextEntry::make('deleted_by')
                    ->numeric(),
                TextEntry::make('quote.id'),
                TextEntry::make('vehicle.id'),
                TextEntry::make('vehicle_amount')
                    ->numeric(),
                TextEntry::make('vehicle_loan_amount')
                    ->numeric(),
                IconEntry::make('is_employee')
                    ->boolean(),
                IconEntry::make('leasing')
                    ->boolean(),
            ]);
    }
}
