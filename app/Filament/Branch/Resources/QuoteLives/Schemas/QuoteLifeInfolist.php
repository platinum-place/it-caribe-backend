<?php

namespace App\Filament\Branch\Resources\QuoteLives\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class QuoteLifeInfolist
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
                TextEntry::make('quote_life_credit_type_id')
                    ->numeric(),
                TextEntry::make('co_borrower_id')
                    ->numeric(),
                IconEntry::make('guarantor')
                    ->boolean(),
                TextEntry::make('deadline_month')
                    ->numeric(),
                TextEntry::make('deadline_year')
                    ->numeric(),
                TextEntry::make('insured_amount')
                    ->numeric(),
            ]);
    }
}
