<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteTypes;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Quote\Infrastructure\Persistence\Models\QuoteType;
use Modules\Quote\Presentation\Filament\Resources\QuoteTypes\Pages\CreateQuoteType;
use Modules\Quote\Presentation\Filament\Resources\QuoteTypes\Pages\EditQuoteType;
use Modules\Quote\Presentation\Filament\Resources\QuoteTypes\Pages\ListQuoteTypes;
use Modules\Quote\Presentation\Filament\Resources\QuoteTypes\Pages\ViewQuoteType;
use Modules\Quote\Presentation\Filament\Resources\QuoteTypes\Schemas\QuoteTypeForm;
use Modules\Quote\Presentation\Filament\Resources\QuoteTypes\Schemas\QuoteTypeInfolist;
use Modules\Quote\Presentation\Filament\Resources\QuoteTypes\Tables\QuoteTypesTable;

class QuoteTypeResource extends Resource
{
    protected static ?string $model = QuoteType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return QuoteTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuoteTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuoteTypesTable::configure($table);
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
            'index' => ListQuoteTypes::route('/'),
            'create' => CreateQuoteType::route('/create'),
            'view' => ViewQuoteType::route('/{record}'),
            'edit' => EditQuoteType::route('/{record}/edit'),
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
