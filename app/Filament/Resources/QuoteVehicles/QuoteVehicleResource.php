<?php

namespace App\Filament\Resources\QuoteVehicles;

use App\Filament\Resources\QuoteVehicles\Pages\CreateQuoteVehicle;
use App\Filament\Resources\QuoteVehicles\Pages\EditQuoteVehicle;
use App\Filament\Resources\QuoteVehicles\Pages\ListQuoteVehicles;
use App\Filament\Resources\QuoteVehicles\Pages\ViewQuoteVehicle;
use App\Filament\Resources\QuoteVehicles\Schemas\QuoteVehicleForm;
use App\Filament\Resources\QuoteVehicles\Schemas\QuoteVehicleInfolist;
use App\Filament\Resources\QuoteVehicles\Tables\QuoteVehiclesTable;
use App\Models\Quote\Vehicle\QuoteVehicle;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuoteVehicleResource extends Resource
{
    protected static ?string $model = QuoteVehicle::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return QuoteVehicleForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuoteVehicleInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuoteVehiclesTable::configure($table);
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
            'index' => ListQuoteVehicles::route('/'),
            'create' => CreateQuoteVehicle::route('/create'),
            'view' => ViewQuoteVehicle::route('/{record}'),
            'edit' => EditQuoteVehicle::route('/{record}/edit'),
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
