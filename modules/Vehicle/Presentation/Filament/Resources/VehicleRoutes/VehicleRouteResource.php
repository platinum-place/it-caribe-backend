<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleRoutes;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleRoute;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleRoutes\Pages\CreateVehicleRoute;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleRoutes\Pages\EditVehicleRoute;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleRoutes\Pages\ListVehicleRoutes;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleRoutes\Pages\ViewVehicleRoute;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleRoutes\Schemas\VehicleRouteForm;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleRoutes\Schemas\VehicleRouteInfolist;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleRoutes\Tables\VehicleRoutesTable;

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
