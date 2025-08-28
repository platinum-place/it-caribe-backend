<?php

namespace App\Filament\Resources\Quote\QuoteStatuses;

use App\Filament\Resources\Quote\QuoteStatuses\Pages\CreateQuoteStatus;
use App\Filament\Resources\Quote\QuoteStatuses\Pages\EditQuoteStatus;
use App\Filament\Resources\Quote\QuoteStatuses\Pages\ListQuoteStatuses;
use App\Filament\Resources\Quote\QuoteStatuses\Pages\ViewQuoteStatus;
use App\Filament\Resources\Quote\QuoteStatuses\Schemas\QuoteStatusForm;
use App\Filament\Resources\Quote\QuoteStatuses\Schemas\QuoteStatusInfolist;
use App\Filament\Resources\Quote\QuoteStatuses\Tables\QuoteStatusesTable;
use App\Models\Quote\QuoteStatus;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuoteStatusResource extends Resource
{
    protected static ?string $model = QuoteStatus::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return QuoteStatusForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuoteStatusInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuoteStatusesTable::configure($table);
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
            'index' => ListQuoteStatuses::route('/'),
            'create' => CreateQuoteStatus::route('/create'),
            'view' => ViewQuoteStatus::route('/{record}'),
            'edit' => EditQuoteStatus::route('/{record}/edit'),
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
