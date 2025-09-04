<?php

namespace Modules\Presentation\Quotations\Products\DebtUnemployment\Filament\Resources\QuoteDebtUnemployments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class QuoteDebtUnemploymentInfolist
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
                TextEntry::make('quote_unemployment_employment_type_id')
                    ->numeric(),
                TextEntry::make('vehicle_id')
                    ->numeric(),
                TextEntry::make('branch.name'),
                TextEntry::make('deadline_month')
                    ->numeric(),
                TextEntry::make('deadline_year')
                    ->numeric(),
                TextEntry::make('vehicle_amount')
                    ->numeric(),
                TextEntry::make('loan_amount')
                    ->numeric(),
                TextEntry::make('insured_amount')
                    ->numeric(),
            ]);
    }
}
