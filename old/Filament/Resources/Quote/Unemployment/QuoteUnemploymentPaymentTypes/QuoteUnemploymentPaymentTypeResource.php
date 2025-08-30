<?php

namespace App\Filament\Resources\Quote\Unemployment\QuoteUnemploymentPaymentTypes;

use App\Models\QuoteUnemploymentPaymentType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use old\Filament\Resources\Quote\Unemployment\QuoteUnemploymentPaymentTypes\Pages\CreateQuoteUnemploymentPaymentType;
use old\Filament\Resources\Quote\Unemployment\QuoteUnemploymentPaymentTypes\Pages\EditQuoteUnemploymentPaymentType;
use old\Filament\Resources\Quote\Unemployment\QuoteUnemploymentPaymentTypes\Pages\ListQuoteUnemploymentPaymentTypes;
use old\Filament\Resources\Quote\Unemployment\QuoteUnemploymentPaymentTypes\Pages\ViewQuoteUnemploymentPaymentType;
use old\Filament\Resources\Quote\Unemployment\QuoteUnemploymentPaymentTypes\Schemas\QuoteUnemploymentPaymentTypeForm;
use old\Filament\Resources\Quote\Unemployment\QuoteUnemploymentPaymentTypes\Schemas\QuoteUnemploymentPaymentTypeInfolist;
use old\Filament\Resources\Quote\Unemployment\QuoteUnemploymentPaymentTypes\Tables\QuoteUnemploymentPaymentTypesTable;

class QuoteUnemploymentPaymentTypeResource extends Resource
{
    protected static ?string $model = QuoteUnemploymentPaymentType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): ?string
    {
        return __('Quote');
    }

    public static function form(Schema $schema): Schema
    {
        return QuoteUnemploymentPaymentTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuoteUnemploymentPaymentTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuoteUnemploymentPaymentTypesTable::configure($table);
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
            'index' => ListQuoteUnemploymentPaymentTypes::route('/'),
            'create' => CreateQuoteUnemploymentPaymentType::route('/create'),
            'view' => ViewQuoteUnemploymentPaymentType::route('/{record}'),
            'edit' => EditQuoteUnemploymentPaymentType::route('/{record}/edit'),
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
