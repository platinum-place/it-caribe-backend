<?php

namespace App\Filament\Resources\VehicleRoutes;

use App\Filament\Resources\VehicleRoutes\Pages\CreateVehicleRoute;
use App\Filament\Resources\VehicleRoutes\Pages\EditVehicleRoute;
use App\Filament\Resources\VehicleRoutes\Pages\ListVehicleRoutes;
use App\Filament\Resources\VehicleRoutes\Pages\ViewVehicleRoute;
use App\Filament\Resources\VehicleRoutes\Schemas\VehicleRouteForm;
use App\Filament\Resources\VehicleRoutes\Schemas\VehicleRouteInfolist;
use App\Filament\Resources\VehicleRoutes\Tables\VehicleRoutesTable;
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
