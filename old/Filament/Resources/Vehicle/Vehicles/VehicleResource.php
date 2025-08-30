<?php

namespace App\Filament\Resources\Vehicle\Vehicles;

use App\Filament\Resources\Vehicle\Vehicles\Pages\EditVehicle;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Vehicle\Models\Vehicle;
use old\Filament\Resources\Vehicle\Vehicles\Pages\CreateVehicle;
use old\Filament\Resources\Vehicle\Vehicles\Pages\ListVehicles;
use old\Filament\Resources\Vehicle\Vehicles\Pages\ViewVehicle;
use old\Filament\Resources\Vehicle\Vehicles\Schemas\VehicleForm;
use old\Filament\Resources\Vehicle\Vehicles\Schemas\VehicleInfolist;
use old\Filament\Resources\Vehicle\Vehicles\Tables\VehiclesTable;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'chassis';

    public static function getNavigationGroup(): ?string
    {
        return __('Vehicle');
    }

    public static function form(Schema $schema): Schema
    {
        return VehicleForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VehicleInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VehiclesTable::configure($table);
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
            'index' => ListVehicles::route('/'),
            'create' => CreateVehicle::route('/create'),
            'view' => ViewVehicle::route('/{record}'),
            'edit' => EditVehicle::route('/{record}/edit'),
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
