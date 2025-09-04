<?php

namespace Modules\Presentation\Quotations\Products\Life\Filament\Resources\QuoteLives;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Infrastructure\Quotations\Products\Life\Persistence\Models\QuoteLife;
use Modules\Presentation\Quotations\Products\Life\Filament\Resources\QuoteLives\Pages\CreateQuoteLife;
use Modules\Presentation\Quotations\Products\Life\Filament\Resources\QuoteLives\Pages\EditQuoteLife;
use Modules\Presentation\Quotations\Products\Life\Filament\Resources\QuoteLives\Pages\ListQuoteLives;
use Modules\Presentation\Quotations\Products\Life\Filament\Resources\QuoteLives\Pages\ViewQuoteLife;
use Modules\Presentation\Quotations\Products\Life\Filament\Resources\QuoteLives\Schemas\QuoteLifeForm;
use Modules\Presentation\Quotations\Products\Life\Filament\Resources\QuoteLives\Schemas\QuoteLifeInfolist;
use Modules\Presentation\Quotations\Products\Life\Filament\Resources\QuoteLives\Tables\QuoteLivesTable;

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
