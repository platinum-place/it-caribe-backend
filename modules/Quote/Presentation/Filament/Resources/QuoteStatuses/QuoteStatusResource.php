<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteStatuses;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Quote\Infrastructure\Persistence\Models\QuoteStatus;
use Modules\Quote\Presentation\Filament\Resources\QuoteStatuses\Pages\CreateQuoteStatus;
use Modules\Quote\Presentation\Filament\Resources\QuoteStatuses\Pages\EditQuoteStatus;
use Modules\Quote\Presentation\Filament\Resources\QuoteStatuses\Pages\ListQuoteStatuses;
use Modules\Quote\Presentation\Filament\Resources\QuoteStatuses\Pages\ViewQuoteStatus;
use Modules\Quote\Presentation\Filament\Resources\QuoteStatuses\Schemas\QuoteStatusForm;
use Modules\Quote\Presentation\Filament\Resources\QuoteStatuses\Schemas\QuoteStatusInfolist;
use Modules\Quote\Presentation\Filament\Resources\QuoteStatuses\Tables\QuoteStatusesTable;

class QuoteStatusResource extends Resource
{
    protected static ?string $model = QuoteStatus::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

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
