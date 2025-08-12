<?php

namespace Modules\Quote\Presentation\Filament\Resources\QuoteLineStatuses;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Quote\Infrastructure\Persistence\Models\QuoteLineStatus;
use Modules\Quote\Presentation\Filament\Resources\QuoteLineStatuses\Pages\CreateQuoteLineStatus;
use Modules\Quote\Presentation\Filament\Resources\QuoteLineStatuses\Pages\EditQuoteLineStatus;
use Modules\Quote\Presentation\Filament\Resources\QuoteLineStatuses\Pages\ListQuoteLineStatuses;
use Modules\Quote\Presentation\Filament\Resources\QuoteLineStatuses\Pages\ViewQuoteLineStatus;
use Modules\Quote\Presentation\Filament\Resources\QuoteLineStatuses\Schemas\QuoteLineStatusForm;
use Modules\Quote\Presentation\Filament\Resources\QuoteLineStatuses\Schemas\QuoteLineStatusInfolist;
use Modules\Quote\Presentation\Filament\Resources\QuoteLineStatuses\Tables\QuoteLineStatusesTable;

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
