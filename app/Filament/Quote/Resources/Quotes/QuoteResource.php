<?php

namespace App\Filament\Quote\Resources\Quotes;

use App\Filament\Quote\Resources\Quotes\Pages\CreateQuote;
use App\Filament\Quote\Resources\Quotes\Pages\EditQuote;
use App\Filament\Quote\Resources\Quotes\Pages\ListQuotes;
use App\Filament\Quote\Resources\Quotes\Pages\ViewQuote;
use App\Filament\Quote\Resources\Quotes\Schemas\QuoteForm;
use App\Filament\Quote\Resources\Quotes\Schemas\QuoteInfolist;
use App\Filament\Quote\Resources\Quotes\Tables\QuotesTable;
use App\Models\Quote\Quote;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
