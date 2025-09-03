<?php

namespace App\Filament\Branch\Resources\QuoteLives;

use App\Filament\Branch\Resources\QuoteLives\Pages\CreateQuoteLife;
use App\Filament\Branch\Resources\QuoteLives\Pages\EditQuoteLife;
use App\Filament\Branch\Resources\QuoteLives\Pages\ListQuoteLives;
use App\Filament\Branch\Resources\QuoteLives\Pages\ViewQuoteLife;
use App\Filament\Branch\Resources\QuoteLives\Schemas\QuoteLifeForm;
use App\Filament\Branch\Resources\QuoteLives\Schemas\QuoteLifeInfolist;
use App\Filament\Branch\Resources\QuoteLives\Tables\QuoteLivesTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Infrastructure\Quotations\Products\Life\Persistence\Models\QuoteLife;

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
