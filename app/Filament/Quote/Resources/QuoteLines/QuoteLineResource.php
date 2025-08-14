<?php

namespace App\Filament\Quote\Resources\QuoteLines;

use App\Filament\Quote\Resources\QuoteLines\Pages\CreateQuoteLine;
use App\Filament\Quote\Resources\QuoteLines\Pages\EditQuoteLine;
use App\Filament\Quote\Resources\QuoteLines\Pages\ListQuoteLines;
use App\Filament\Quote\Resources\QuoteLines\Pages\ViewQuoteLine;
use App\Filament\Quote\Resources\QuoteLines\Schemas\QuoteLineForm;
use App\Filament\Quote\Resources\QuoteLines\Schemas\QuoteLineInfolist;
use App\Filament\Quote\Resources\QuoteLines\Tables\QuoteLinesTable;
use App\Models\Quote\QuoteLine;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuoteLineResource extends Resource
{
    protected static ?string $model = QuoteLine::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return QuoteLineForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuoteLineInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuoteLinesTable::configure($table);
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
            'index' => ListQuoteLines::route('/'),
            'create' => CreateQuoteLine::route('/create'),
            'view' => ViewQuoteLine::route('/{record}'),
            'edit' => EditQuoteLine::route('/{record}/edit'),
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
