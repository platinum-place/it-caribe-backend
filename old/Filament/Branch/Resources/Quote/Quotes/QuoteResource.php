<?php

namespace App\Filament\Branch\Resources\Quote\Quotes;

use old\Filament\Branch\Resources\Quote\Quotes\Pages\CreateQuote;
use old\Filament\Branch\Resources\Quote\Quotes\Pages\EditQuote;
use old\Filament\Branch\Resources\Quote\Quotes\Pages\ListQuotes;
use old\Filament\Branch\Resources\Quote\Quotes\Pages\ViewQuote;
use old\Filament\Branch\Resources\Quote\Quotes\Schemas\QuoteForm;
use old\Filament\Branch\Resources\Quote\Quotes\Schemas\QuoteInfolist;
use old\Filament\Branch\Resources\Quote\Quotes\Tables\QuotesTable;
use App\Models\Quote;
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
            \old\Filament\Branch\Resources\Quote\Quotes\RelationManagers\LinesRelationManager::class,
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
