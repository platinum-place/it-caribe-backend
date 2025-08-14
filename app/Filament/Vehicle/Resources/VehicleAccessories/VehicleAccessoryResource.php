<?php

namespace App\Filament\Vehicle\Resources\VehicleAccessories;

use App\Filament\Vehicle\Resources\VehicleAccessories\Pages\CreateVehicleAccessory;
use App\Filament\Vehicle\Resources\VehicleAccessories\Pages\EditVehicleAccessory;
use App\Filament\Vehicle\Resources\VehicleAccessories\Pages\ListVehicleAccessories;
use App\Filament\Vehicle\Resources\VehicleAccessories\Pages\ViewVehicleAccessory;
use App\Filament\Vehicle\Resources\VehicleAccessories\Schemas\VehicleAccessoryForm;
use App\Filament\Vehicle\Resources\VehicleAccessories\Schemas\VehicleAccessoryInfolist;
use App\Filament\Vehicle\Resources\VehicleAccessories\Tables\VehicleAccessoriesTable;
use App\Models\Vehicle\VehicleAccessory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleAccessoryResource extends Resource
{
    protected static ?string $model = VehicleAccessory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return VehicleAccessoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VehicleAccessoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VehicleAccessoriesTable::configure($table);
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
            'index' => ListVehicleAccessories::route('/'),
            'create' => CreateVehicleAccessory::route('/create'),
            'view' => ViewVehicleAccessory::route('/{record}'),
            'edit' => EditVehicleAccessory::route('/{record}/edit'),
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
