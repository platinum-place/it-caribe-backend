<?php

namespace App\Filament\Vehicle\Resources\VehicleRoutes;

use App\Filament\Vehicle\Resources\VehicleRoutes\Pages\CreateVehicleRoute;
use App\Filament\Vehicle\Resources\VehicleRoutes\Pages\EditVehicleRoute;
use App\Filament\Vehicle\Resources\VehicleRoutes\Pages\ListVehicleRoutes;
use App\Filament\Vehicle\Resources\VehicleRoutes\Pages\ViewVehicleRoute;
use App\Filament\Vehicle\Resources\VehicleRoutes\Schemas\VehicleRouteForm;
use App\Filament\Vehicle\Resources\VehicleRoutes\Schemas\VehicleRouteInfolist;
use App\Filament\Vehicle\Resources\VehicleRoutes\Tables\VehicleRoutesTable;
use App\Models\Vehicle\VehicleRoute;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleRouteResource extends Resource
{
    protected static ?string $model = VehicleRoute::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return VehicleRouteForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VehicleRouteInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VehicleRoutesTable::configure($table);
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
            'index' => ListVehicleRoutes::route('/'),
            'create' => CreateVehicleRoute::route('/create'),
            'view' => ViewVehicleRoute::route('/{record}'),
            'edit' => EditVehicleRoute::route('/{record}/edit'),
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
