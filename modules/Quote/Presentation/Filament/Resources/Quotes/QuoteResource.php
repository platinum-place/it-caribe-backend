<?php

namespace Modules\Quote\Presentation\Filament\Resources\Quotes;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Quote\Infrastructure\Persistence\Models\Quote;
use Modules\Quote\Presentation\Filament\Resources\Quotes\Pages\CreateQuote;
use Modules\Quote\Presentation\Filament\Resources\Quotes\Pages\EditQuote;
use Modules\Quote\Presentation\Filament\Resources\Quotes\Pages\ListQuotes;
use Modules\Quote\Presentation\Filament\Resources\Quotes\Pages\ViewQuote;
use Modules\Quote\Presentation\Filament\Resources\Quotes\Schemas\QuoteForm;
use Modules\Quote\Presentation\Filament\Resources\Quotes\Schemas\QuoteInfolist;
use Modules\Quote\Presentation\Filament\Resources\Quotes\Tables\QuotesTable;

class QuoteResource extends Resource
{
    protected static ?string $model = Quote::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'start_date';

    public static function form(Schema $schema): Schema
    {
        return QuoteForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuoteInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuotesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListQuotes::route('/'),
            'create' => CreateQuote::route('/create'),
            'view' => ViewQuote::route('/{record}'),
            'edit' => EditQuote::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
