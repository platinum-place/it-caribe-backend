<?php

namespace Modules\Presentation\Quotations\Products\Unemployment\Filament\Resources\QuoteUnemployments;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Infrastructure\Quotations\Products\Unemployment\Persistence\Models\QuoteUnemployment;
use Modules\Presentation\Quotations\Products\Unemployment\Filament\Resources\QuoteUnemployments\Pages\CreateQuoteUnemployment;
use Modules\Presentation\Quotations\Products\Unemployment\Filament\Resources\QuoteUnemployments\Pages\EditQuoteUnemployment;
use Modules\Presentation\Quotations\Products\Unemployment\Filament\Resources\QuoteUnemployments\Pages\ListQuoteUnemployments;
use Modules\Presentation\Quotations\Products\Unemployment\Filament\Resources\QuoteUnemployments\Pages\ViewQuoteUnemployment;
use Modules\Presentation\Quotations\Products\Unemployment\Filament\Resources\QuoteUnemployments\Schemas\QuoteUnemploymentForm;
use Modules\Presentation\Quotations\Products\Unemployment\Filament\Resources\QuoteUnemployments\Schemas\QuoteUnemploymentInfolist;
use Modules\Presentation\Quotations\Products\Unemployment\Filament\Resources\QuoteUnemployments\Tables\QuoteUnemploymentsTable;

class QuoteUnemploymentResource extends Resource
{
    protected static ?string $model = QuoteUnemployment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return QuoteUnemploymentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuoteUnemploymentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuoteUnemploymentsTable::configure($table);
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
            'index' => ListQuoteUnemployments::route('/'),
            'create' => CreateQuoteUnemployment::route('/create'),
            'view' => ViewQuoteUnemployment::route('/{record}'),
            'edit' => EditQuoteUnemployment::route('/{record}/edit'),
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
