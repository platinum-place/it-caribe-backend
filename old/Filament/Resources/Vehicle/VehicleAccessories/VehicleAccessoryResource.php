<?php

namespace App\Filament\Resources\Vehicle\VehicleAccessories;

use old\Filament\Resources\Vehicle\VehicleAccessories\Pages\CreateVehicleAccessory;
use old\Filament\Resources\Vehicle\VehicleAccessories\Pages\EditVehicleAccessory;
use old\Filament\Resources\Vehicle\VehicleAccessories\Pages\ListVehicleAccessories;
use old\Filament\Resources\Vehicle\VehicleAccessories\Pages\ViewVehicleAccessory;
use old\Filament\Resources\Vehicle\VehicleAccessories\Schemas\VehicleAccessoryForm;
use old\Filament\Resources\Vehicle\VehicleAccessories\Schemas\VehicleAccessoryInfolist;
use old\Filament\Resources\Vehicle\VehicleAccessories\Tables\VehicleAccessoriesTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Vehicle\Models\VehicleAccessory;

class VehicleAccessoryResource extends Resource
{
    protected static ?string $model = VehicleAccessory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): ?string
    {
        return __('Vehicle');
    }

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
