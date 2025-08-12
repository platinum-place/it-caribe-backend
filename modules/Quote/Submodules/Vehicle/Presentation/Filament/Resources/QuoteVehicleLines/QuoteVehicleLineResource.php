<?php

namespace Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources\QuoteVehicleLines;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Quote\Submodules\Vehicle\Infrastructure\Persistence\Models\QuoteVehicleLine;
use Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources\QuoteVehicleLines\Pages\CreateQuoteVehicleLine;
use Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources\QuoteVehicleLines\Pages\EditQuoteVehicleLine;
use Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources\QuoteVehicleLines\Pages\ListQuoteVehicleLines;
use Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources\QuoteVehicleLines\Pages\ViewQuoteVehicleLine;
use Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources\QuoteVehicleLines\Schemas\QuoteVehicleLineForm;
use Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources\QuoteVehicleLines\Schemas\QuoteVehicleLineInfolist;
use Modules\Quote\Submodules\Vehicle\Presentation\Filament\Resources\QuoteVehicleLines\Tables\QuoteVehicleLinesTable;

class QuoteVehicleLineResource extends Resource
{
    protected static ?string $model = QuoteVehicleLine::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return QuoteVehicleLineForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuoteVehicleLineInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuoteVehicleLinesTable::configure($table);
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
            'index' => ListQuoteVehicleLines::route('/'),
            'create' => CreateQuoteVehicleLine::route('/create'),
            'view' => ViewQuoteVehicleLine::route('/{record}'),
            'edit' => EditQuoteVehicleLine::route('/{record}/edit'),
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
