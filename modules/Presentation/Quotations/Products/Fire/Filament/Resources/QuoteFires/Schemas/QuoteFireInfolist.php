<?php

namespace Modules\Presentation\Quotations\Products\Fire\Filament\Resources\QuoteFires\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class QuoteFireInfolist
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
                TextEntry::make('quote_fire_construction_type_id')
                    ->numeric(),
                TextEntry::make('quote_fire_credit_type_id')
                    ->numeric(),
                TextEntry::make('quote_fire_risk_type_id')
                    ->numeric(),
                TextEntry::make('branch.name'),
                TextEntry::make('co_borrower_id')
                    ->numeric(),
                IconEntry::make('guarantor')
                    ->boolean(),
                TextEntry::make('deadline_month')
                    ->numeric(),
                TextEntry::make('deadline_year')
                    ->numeric(),
                TextEntry::make('appraisal_value')
                    ->numeric(),
                TextEntry::make('financed_value')
                    ->numeric(),
            ]);
    }
}
