<?php

namespace Modules\Quote\Vehicle\Presentation\Filament\Resources\QuoteVehicleLines\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class QuoteVehicleLineInfolist
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
                TextEntry::make('quote_vehicle_id')
                    ->numeric(),
                TextEntry::make('quote_line_id')
                    ->numeric(),
                TextEntry::make('life_amount')
                    ->numeric(),
                TextEntry::make('latest_expenses')
                    ->numeric(),
                TextEntry::make('markup')
                    ->numeric(),
                TextEntry::make('vehicle_rate')
                    ->numeric(),
            ]);
    }
}
