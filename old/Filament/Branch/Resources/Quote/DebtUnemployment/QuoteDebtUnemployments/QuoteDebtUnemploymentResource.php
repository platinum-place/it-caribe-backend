<?php

namespace App\Filament\Branch\Resources\Quote\DebtUnemployment\QuoteDebtUnemployments;

use App\Filament\Branch\Resources\Quote\DebtUnemployment\QuoteDebtUnemployments\Pages\ViewQuoteDebtUnemployment;
use App\Models\QuoteDebtUnemployment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use old\Filament\Branch\Resources\Quote\DebtUnemployment\QuoteDebtUnemployments\Pages\CreateQuoteDebtUnemployment;
use old\Filament\Branch\Resources\Quote\DebtUnemployment\QuoteDebtUnemployments\Pages\EditQuoteDebtUnemployment;
use old\Filament\Branch\Resources\Quote\DebtUnemployment\QuoteDebtUnemployments\Pages\ListQuoteDebtUnemployments;
use old\Filament\Branch\Resources\Quote\DebtUnemployment\QuoteDebtUnemployments\Schemas\QuoteDebtUnemploymentForm;
use old\Filament\Branch\Resources\Quote\DebtUnemployment\QuoteDebtUnemployments\Schemas\QuoteDebtUnemploymentInfolist;
use old\Filament\Branch\Resources\Quote\DebtUnemployment\QuoteDebtUnemployments\Tables\QuoteDebtUnemploymentsTable;

class QuoteDebtUnemploymentResource extends Resource
{
    protected static ?string $model = QuoteDebtUnemployment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return QuoteDebtUnemploymentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuoteDebtUnemploymentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuoteDebtUnemploymentsTable::configure($table);
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
            'index' => ListQuoteDebtUnemployments::route('/'),
            'create' => CreateQuoteDebtUnemployment::route('/create'),
            'view' => ViewQuoteDebtUnemployment::route('/{record}'),
            'edit' => EditQuoteDebtUnemployment::route('/{record}/edit'),
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
