<?php

namespace App\Filament\QuoteVehicle\Resources\QuoteVehicleLines;

use App\Filament\QuoteVehicle\Resources\QuoteVehicleLines\Pages\CreateQuoteVehicleLine;
use App\Filament\QuoteVehicle\Resources\QuoteVehicleLines\Pages\EditQuoteVehicleLine;
use App\Filament\QuoteVehicle\Resources\QuoteVehicleLines\Pages\ListQuoteVehicleLines;
use App\Filament\QuoteVehicle\Resources\QuoteVehicleLines\Pages\ViewQuoteVehicleLine;
use App\Filament\QuoteVehicle\Resources\QuoteVehicleLines\Schemas\QuoteVehicleLineForm;
use App\Filament\QuoteVehicle\Resources\QuoteVehicleLines\Schemas\QuoteVehicleLineInfolist;
use App\Filament\QuoteVehicle\Resources\QuoteVehicleLines\Tables\QuoteVehicleLinesTable;
use App\Models\Quote\Vehicle\QuoteVehicleLine;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
