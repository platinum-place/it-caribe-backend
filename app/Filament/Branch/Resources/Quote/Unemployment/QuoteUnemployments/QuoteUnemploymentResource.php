<?php

namespace App\Filament\Branch\Resources\Quote\Unemployment\QuoteUnemployments;

use App\Filament\Branch\Resources\Quote\Unemployment\QuoteUnemployments\Pages\CreateQuoteUnemployment;
use App\Filament\Branch\Resources\Quote\Unemployment\QuoteUnemployments\Pages\EditQuoteUnemployment;
use App\Filament\Branch\Resources\Quote\Unemployment\QuoteUnemployments\Pages\ListQuoteUnemployments;
use App\Filament\Branch\Resources\Quote\Unemployment\QuoteUnemployments\Pages\ViewQuoteUnemployment;
use App\Filament\Branch\Resources\Quote\Unemployment\QuoteUnemployments\Schemas\QuoteUnemploymentForm;
use App\Filament\Branch\Resources\Quote\Unemployment\QuoteUnemployments\Schemas\QuoteUnemploymentInfolist;
use App\Filament\Branch\Resources\Quote\Unemployment\QuoteUnemployments\Tables\QuoteUnemploymentsTable;
use App\Models\Quote\Unemployment\QuoteUnemployment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
