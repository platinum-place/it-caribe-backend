<?php

namespace Modules\Presentation\Quotations\Products\Fire\Filament\Resources\QuoteFires;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Infrastructure\Quotations\Products\Fire\Persistence\Models\QuoteFire;
use Modules\Presentation\Quotations\Products\Fire\Filament\Resources\QuoteFires\Pages\CreateQuoteFire;
use Modules\Presentation\Quotations\Products\Fire\Filament\Resources\QuoteFires\Pages\EditQuoteFire;
use Modules\Presentation\Quotations\Products\Fire\Filament\Resources\QuoteFires\Pages\ListQuoteFires;
use Modules\Presentation\Quotations\Products\Fire\Filament\Resources\QuoteFires\Pages\ViewQuoteFire;
use Modules\Presentation\Quotations\Products\Fire\Filament\Resources\QuoteFires\Schemas\QuoteFireForm;
use Modules\Presentation\Quotations\Products\Fire\Filament\Resources\QuoteFires\Schemas\QuoteFireInfolist;
use Modules\Presentation\Quotations\Products\Fire\Filament\Resources\QuoteFires\Tables\QuoteFiresTable;

class QuoteFireResource extends Resource
{
    protected static ?string $model = QuoteFire::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return QuoteFireForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuoteFireInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuoteFiresTable::configure($table);
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
            'index' => ListQuoteFires::route('/'),
            'create' => CreateQuoteFire::route('/create'),
            'view' => ViewQuoteFire::route('/{record}'),
            'edit' => EditQuoteFire::route('/{record}/edit'),
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
