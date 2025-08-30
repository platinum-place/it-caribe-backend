<?php

namespace App\Filament\Branch\Resources\Quote\Fire\QuoteFires;

use App\Filament\Branch\Resources\Quote\Fire\QuoteFires\Pages\EditQuoteFire;
use App\Filament\Branch\Resources\Quote\Fire\QuoteFires\Tables\QuoteFiresTable;
use App\Models\QuoteFire;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use old\Filament\Branch\Resources\Quote\Fire\QuoteFires\Pages\CreateQuoteFire;
use old\Filament\Branch\Resources\Quote\Fire\QuoteFires\Pages\ListQuoteFires;
use old\Filament\Branch\Resources\Quote\Fire\QuoteFires\Pages\ViewQuoteFire;
use old\Filament\Branch\Resources\Quote\Fire\QuoteFires\Schemas\QuoteFireForm;
use old\Filament\Branch\Resources\Quote\Fire\QuoteFires\Schemas\QuoteFireInfolist;

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
