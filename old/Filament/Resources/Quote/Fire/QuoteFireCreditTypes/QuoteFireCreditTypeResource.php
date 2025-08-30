<?php

namespace App\Filament\Resources\Quote\Fire\QuoteFireCreditTypes;

use App\Filament\Resources\Quote\Fire\QuoteFireCreditTypes\Schemas\QuoteFireCreditTypeInfolist;
use App\Filament\Resources\Quote\Fire\QuoteFireCreditTypes\Tables\QuoteFireCreditTypesTable;
use App\Models\QuoteFireCreditType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use old\Filament\Resources\Quote\Fire\QuoteFireCreditTypes\Pages\CreateQuoteFireCreditType;
use old\Filament\Resources\Quote\Fire\QuoteFireCreditTypes\Pages\EditQuoteFireCreditType;
use old\Filament\Resources\Quote\Fire\QuoteFireCreditTypes\Pages\ListQuoteFireCreditTypes;
use old\Filament\Resources\Quote\Fire\QuoteFireCreditTypes\Pages\ViewQuoteFireCreditType;
use old\Filament\Resources\Quote\Fire\QuoteFireCreditTypes\Schemas\QuoteFireCreditTypeForm;

class QuoteFireCreditTypeResource extends Resource
{
    protected static ?string $model = QuoteFireCreditType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): ?string
    {
        return __('Quote');
    }

    public static function form(Schema $schema): Schema
    {
        return QuoteFireCreditTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuoteFireCreditTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuoteFireCreditTypesTable::configure($table);
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
            'index' => ListQuoteFireCreditTypes::route('/'),
            'create' => CreateQuoteFireCreditType::route('/create'),
            'view' => ViewQuoteFireCreditType::route('/{record}'),
            'edit' => EditQuoteFireCreditType::route('/{record}/edit'),
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
