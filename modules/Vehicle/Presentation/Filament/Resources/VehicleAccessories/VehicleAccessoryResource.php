<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleAccessories;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleAccessory;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleAccessories\Pages\CreateVehicleAccessory;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleAccessories\Pages\EditVehicleAccessory;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleAccessories\Pages\ListVehicleAccessories;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleAccessories\Pages\ViewVehicleAccessory;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleAccessories\Schemas\VehicleAccessoryForm;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleAccessories\Schemas\VehicleAccessoryInfolist;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleAccessories\Tables\VehicleAccessoriesTable;

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
