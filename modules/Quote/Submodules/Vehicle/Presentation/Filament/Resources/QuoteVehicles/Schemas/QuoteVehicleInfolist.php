<?php

namespace Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources\QuoteVehicles\Schemas;

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
                TextEntry::make('quote_id')
                    ->numeric(),
                TextEntry::make('vehicle_make_id')
                    ->numeric(),
                TextEntry::make('vehicle_model_id')
                    ->numeric(),
                TextEntry::make('vehicle_type_id')
                    ->numeric(),
                TextEntry::make('vehicle_use_id')
                    ->numeric(),
                TextEntry::make('vehicle_activity_id')
                    ->numeric(),
                TextEntry::make('vehicle_loan_type_id')
                    ->numeric(),
                TextEntry::make('vehicle_utility_id')
                    ->numeric(),
                TextEntry::make('vehicle_amount')
                    ->numeric(),
                TextEntry::make('loan_amount')
                    ->numeric(),
                TextEntry::make('vehicle_year')
                    ->numeric(),
                IconEntry::make('is_employee')
                    ->boolean(),
                IconEntry::make('leasing')
                    ->boolean(),
            ]);
    }
}
