<?php

namespace App\Filament\Resources\Quote\Life\QuoteLifeCreditTypes;

use App\Filament\Resources\Quote\Life\QuoteLifeCreditTypes\Pages\CreateQuoteLifeCreditType;
use App\Filament\Resources\Quote\Life\QuoteLifeCreditTypes\Pages\EditQuoteLifeCreditType;
use App\Filament\Resources\Quote\Life\QuoteLifeCreditTypes\Pages\ListQuoteLifeCreditTypes;
use App\Filament\Resources\Quote\Life\QuoteLifeCreditTypes\Pages\ViewQuoteLifeCreditType;
use App\Filament\Resources\Quote\Life\QuoteLifeCreditTypes\Schemas\QuoteLifeCreditTypeForm;
use App\Filament\Resources\Quote\Life\QuoteLifeCreditTypes\Schemas\QuoteLifeCreditTypeInfolist;
use App\Filament\Resources\Quote\Life\QuoteLifeCreditTypes\Tables\QuoteLifeCreditTypesTable;
use App\Models\Quote\Life\QuoteLifeCreditType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuoteLifeCreditTypeResource extends Resource
{
    protected static ?string $model = QuoteLifeCreditType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): ?string
    {
        return __('Quote');
    }

    public static function form(Schema $schema): Schema
    {
        return QuoteLifeCreditTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuoteLifeCreditTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuoteLifeCreditTypesTable::configure($table);
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
            'index' => ListQuoteLifeCreditTypes::route('/'),
            'create' => CreateQuoteLifeCreditType::route('/create'),
            'view' => ViewQuoteLifeCreditType::route('/{record}'),
            'edit' => EditQuoteLifeCreditType::route('/{record}/edit'),
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
