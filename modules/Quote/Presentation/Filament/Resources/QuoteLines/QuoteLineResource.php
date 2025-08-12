<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteLines;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Quote\Infrastructure\Persistence\Models\QuoteLine;
use Modules\Quote\Presentation\Filament\Resources\QuoteLines\Pages\CreateQuoteLine;
use Modules\Quote\Presentation\Filament\Resources\QuoteLines\Pages\EditQuoteLine;
use Modules\Quote\Presentation\Filament\Resources\QuoteLines\Pages\ListQuoteLines;
use Modules\Quote\Presentation\Filament\Resources\QuoteLines\Pages\ViewQuoteLine;
use Modules\Quote\Presentation\Filament\Resources\QuoteLines\Schemas\QuoteLineForm;
use Modules\Quote\Presentation\Filament\Resources\QuoteLines\Schemas\QuoteLineInfolist;
use Modules\Quote\Presentation\Filament\Resources\QuoteLines\Tables\QuoteLinesTable;

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
