<?php

namespace App\Filament\Branch\Resources\Quote\Life\QuoteLives;

use old\Filament\Branch\Resources\Quote\Life\QuoteLives\Pages\CreateQuoteLife;
use old\Filament\Branch\Resources\Quote\Life\QuoteLives\Pages\EditQuoteLife;
use old\Filament\Branch\Resources\Quote\Life\QuoteLives\Pages\ListQuoteLives;
use old\Filament\Branch\Resources\Quote\Life\QuoteLives\Pages\ViewQuoteLife;
use old\Filament\Branch\Resources\Quote\Life\QuoteLives\Schemas\QuoteLifeForm;
use old\Filament\Branch\Resources\Quote\Life\QuoteLives\Schemas\QuoteLifeInfolist;
use old\Filament\Branch\Resources\Quote\Life\QuoteLives\Tables\QuoteLivesTable;
use App\Models\QuoteLife;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuoteLifeResource extends Resource
{
    protected static ?string $model = QuoteLife::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return QuoteLifeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuoteLifeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuoteLivesTable::configure($table);
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
            'index' => ListQuoteLives::route('/'),
            'create' => CreateQuoteLife::route('/create'),
            'view' => ViewQuoteLife::route('/{record}'),
            'edit' => EditQuoteLife::route('/{record}/edit'),
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
