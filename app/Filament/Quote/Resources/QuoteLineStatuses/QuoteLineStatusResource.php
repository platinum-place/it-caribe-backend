<?php

namespace App\Filament\Quote\Resources\QuoteLineStatuses;

use App\Filament\Quote\Resources\QuoteLineStatuses\Pages\CreateQuoteLineStatus;
use App\Filament\Quote\Resources\QuoteLineStatuses\Pages\EditQuoteLineStatus;
use App\Filament\Quote\Resources\QuoteLineStatuses\Pages\ListQuoteLineStatuses;
use App\Filament\Quote\Resources\QuoteLineStatuses\Pages\ViewQuoteLineStatus;
use App\Filament\Quote\Resources\QuoteLineStatuses\Schemas\QuoteLineStatusForm;
use App\Filament\Quote\Resources\QuoteLineStatuses\Schemas\QuoteLineStatusInfolist;
use App\Filament\Quote\Resources\QuoteLineStatuses\Tables\QuoteLineStatusesTable;
use App\Models\Quote\QuoteLineStatus;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuoteLineStatusResource extends Resource
{
    protected static ?string $model = QuoteLineStatus::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return QuoteLineStatusForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuoteLineStatusInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuoteLineStatusesTable::configure($table);
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
            'index' => ListQuoteLineStatuses::route('/'),
            'create' => CreateQuoteLineStatus::route('/create'),
            'view' => ViewQuoteLineStatus::route('/{record}'),
            'edit' => EditQuoteLineStatus::route('/{record}/edit'),
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
