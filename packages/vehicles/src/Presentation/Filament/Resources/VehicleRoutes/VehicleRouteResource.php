<?php

namespace App\Filament\Resources\Vehicle\VehicleRoutes;

use App\Filament\Resources\Vehicle\VehicleRoutes\Pages\ListVehicleRoutes;
use App\Filament\Resources\Vehicle\VehicleRoutes\Schemas\VehicleRouteInfolist;
use App\Filament\Resources\Vehicle\VehicleRoutes\Tables\VehicleRoutesTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use old\Modules\Vehicle\app\Models\VehicleRoute;
use old\Filament\Resources\Vehicle\VehicleRoutes\Pages\CreateVehicleRoute;
use old\Filament\Resources\Vehicle\VehicleRoutes\Pages\EditVehicleRoute;
use old\Filament\Resources\Vehicle\VehicleRoutes\Pages\ViewVehicleRoute;
use old\Filament\Resources\Vehicle\VehicleRoutes\Schemas\VehicleRouteForm;

class VehicleRouteResource extends Resource
{
    protected static ?string $model = VehicleRoute::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): ?string
    {
        return __('Vehicle');
    }

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
