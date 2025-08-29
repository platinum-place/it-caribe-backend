<?php

namespace App\Filament\Resources\Quote\Fire\QuoteFireRiskTypes;

use App\Filament\Resources\Quote\Fire\QuoteFireRiskTypes\Pages\CreateQuoteFireRiskType;
use App\Filament\Resources\Quote\Fire\QuoteFireRiskTypes\Pages\EditQuoteFireRiskType;
use App\Filament\Resources\Quote\Fire\QuoteFireRiskTypes\Pages\ListQuoteFireRiskTypes;
use App\Filament\Resources\Quote\Fire\QuoteFireRiskTypes\Pages\ViewQuoteFireRiskType;
use App\Filament\Resources\Quote\Fire\QuoteFireRiskTypes\Schemas\QuoteFireRiskTypeForm;
use App\Filament\Resources\Quote\Fire\QuoteFireRiskTypes\Schemas\QuoteFireRiskTypeInfolist;
use App\Filament\Resources\Quote\Fire\QuoteFireRiskTypes\Tables\QuoteFireRiskTypesTable;
use App\Models\Quote\Fire\QuoteFireRiskType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuoteFireRiskTypeResource extends Resource
{
    protected static ?string $model = QuoteFireRiskType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return QuoteFireRiskTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuoteFireRiskTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuoteFireRiskTypesTable::configure($table);
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
            'index' => ListQuoteFireRiskTypes::route('/'),
            'create' => CreateQuoteFireRiskType::route('/create'),
            'view' => ViewQuoteFireRiskType::route('/{record}'),
            'edit' => EditQuoteFireRiskType::route('/{record}/edit'),
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
