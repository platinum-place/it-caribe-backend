<?php

namespace Modules\Presentation\Quotations\Products\DebtUnemployment\Filament\Resources\QuoteDebtUnemployments;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Infrastructure\Quotations\Products\DebtUnemployment\Persistence\Models\QuoteDebtUnemployment;
use Modules\Presentation\Quotations\Products\DebtUnemployment\Filament\Resources\QuoteDebtUnemployments\Pages\CreateQuoteDebtUnemployment;
use Modules\Presentation\Quotations\Products\DebtUnemployment\Filament\Resources\QuoteDebtUnemployments\Pages\EditQuoteDebtUnemployment;
use Modules\Presentation\Quotations\Products\DebtUnemployment\Filament\Resources\QuoteDebtUnemployments\Pages\ListQuoteDebtUnemployments;
use Modules\Presentation\Quotations\Products\DebtUnemployment\Filament\Resources\QuoteDebtUnemployments\Pages\ViewQuoteDebtUnemployment;
use Modules\Presentation\Quotations\Products\DebtUnemployment\Filament\Resources\QuoteDebtUnemployments\Schemas\QuoteDebtUnemploymentForm;
use Modules\Presentation\Quotations\Products\DebtUnemployment\Filament\Resources\QuoteDebtUnemployments\Schemas\QuoteDebtUnemploymentInfolist;
use Modules\Presentation\Quotations\Products\DebtUnemployment\Filament\Resources\QuoteDebtUnemployments\Tables\QuoteDebtUnemploymentsTable;

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
