<?php

namespace App\Filament\Resources\Quote\QuoteLineStatuses;

use App\Filament\Resources\Quote\QuoteLineStatuses\Pages\EditQuoteLineStatus;
use App\Filament\Resources\Quote\QuoteLineStatuses\Schemas\QuoteLineStatusInfolist;
use App\Models\QuoteLineStatus;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use old\Filament\Resources\Quote\QuoteLineStatuses\Pages\CreateQuoteLineStatus;
use old\Filament\Resources\Quote\QuoteLineStatuses\Pages\ListQuoteLineStatuses;
use old\Filament\Resources\Quote\QuoteLineStatuses\Pages\ViewQuoteLineStatus;
use old\Filament\Resources\Quote\QuoteLineStatuses\Schemas\QuoteLineStatusForm;
use old\Filament\Resources\Quote\QuoteLineStatuses\Tables\QuoteLineStatusesTable;

class QuoteLineStatusResource extends Resource
{
    protected static ?string $model = QuoteLineStatus::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): ?string
    {
        return __('Quote');
    }

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
