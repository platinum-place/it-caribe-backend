<?php

namespace App\Filament\Resources\Quote\Fire\QuoteFireConstructionTypes;

use App\Filament\Resources\Quote\Fire\QuoteFireConstructionTypes\Pages\CreateQuoteFireConstructionType;
use App\Filament\Resources\Quote\Fire\QuoteFireConstructionTypes\Pages\EditQuoteFireConstructionType;
use App\Filament\Resources\Quote\Fire\QuoteFireConstructionTypes\Pages\ListQuoteFireConstructionTypes;
use App\Filament\Resources\Quote\Fire\QuoteFireConstructionTypes\Pages\ViewQuoteFireConstructionType;
use App\Filament\Resources\Quote\Fire\QuoteFireConstructionTypes\Schemas\QuoteFireConstructionTypeForm;
use App\Filament\Resources\Quote\Fire\QuoteFireConstructionTypes\Schemas\QuoteFireConstructionTypeInfolist;
use App\Filament\Resources\Quote\Fire\QuoteFireConstructionTypes\Tables\QuoteFireConstructionTypesTable;
use App\Models\Quote\Fire\QuoteFireConstructionType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuoteFireConstructionTypeResource extends Resource
{
    protected static ?string $model = QuoteFireConstructionType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): ?string
    {
        return __('Quote');
    }

    public static function form(Schema $schema): Schema
    {
        return QuoteFireConstructionTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuoteFireConstructionTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuoteFireConstructionTypesTable::configure($table);
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
            'index' => ListQuoteFireConstructionTypes::route('/'),
            'create' => CreateQuoteFireConstructionType::route('/create'),
            'view' => ViewQuoteFireConstructionType::route('/{record}'),
            'edit' => EditQuoteFireConstructionType::route('/{record}/edit'),
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
