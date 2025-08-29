<?php

namespace App\Filament\Resources\Quote\Unemployment\QuoteUnemploymentEmploymentTypes;

use App\Filament\Resources\Quote\Unemployment\QuoteUnemploymentEmploymentTypes\Pages\CreateQuoteUnemploymentEmploymentType;
use App\Filament\Resources\Quote\Unemployment\QuoteUnemploymentEmploymentTypes\Pages\EditQuoteUnemploymentEmploymentType;
use App\Filament\Resources\Quote\Unemployment\QuoteUnemploymentEmploymentTypes\Pages\ListQuoteUnemploymentEmploymentTypes;
use App\Filament\Resources\Quote\Unemployment\QuoteUnemploymentEmploymentTypes\Pages\ViewQuoteUnemploymentEmploymentType;
use App\Filament\Resources\Quote\Unemployment\QuoteUnemploymentEmploymentTypes\Schemas\QuoteUnemploymentEmploymentTypeForm;
use App\Filament\Resources\Quote\Unemployment\QuoteUnemploymentEmploymentTypes\Schemas\QuoteUnemploymentEmploymentTypeInfolist;
use App\Filament\Resources\Quote\Unemployment\QuoteUnemploymentEmploymentTypes\Tables\QuoteUnemploymentEmploymentTypesTable;
use App\Models\Quote\Unemployment\QuoteUnemploymentEmploymentType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuoteUnemploymentEmploymentTypeResource extends Resource
{
    protected static ?string $model = QuoteUnemploymentEmploymentType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return QuoteUnemploymentEmploymentTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuoteUnemploymentEmploymentTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuoteUnemploymentEmploymentTypesTable::configure($table);
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
            'index' => ListQuoteUnemploymentEmploymentTypes::route('/'),
            'create' => CreateQuoteUnemploymentEmploymentType::route('/create'),
            'view' => ViewQuoteUnemploymentEmploymentType::route('/{record}'),
            'edit' => EditQuoteUnemploymentEmploymentType::route('/{record}/edit'),
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
