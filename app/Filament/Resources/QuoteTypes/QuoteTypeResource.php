<?php

namespace App\Filament\Resources\QuoteTypes;

use App\Filament\Resources\QuoteTypes\Pages\CreateQuoteType;
use App\Filament\Resources\QuoteTypes\Pages\EditQuoteType;
use App\Filament\Resources\QuoteTypes\Pages\ListQuoteTypes;
use App\Filament\Resources\QuoteTypes\Pages\ViewQuoteType;
use App\Filament\Resources\QuoteTypes\Schemas\QuoteTypeForm;
use App\Filament\Resources\QuoteTypes\Schemas\QuoteTypeInfolist;
use App\Filament\Resources\QuoteTypes\Tables\QuoteTypesTable;
use App\Models\Quote\QuoteType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
