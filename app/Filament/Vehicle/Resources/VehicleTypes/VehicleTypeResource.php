<?php

namespace App\Filament\Vehicle\Resources\VehicleTypes;

use App\Filament\Vehicle\Resources\VehicleTypes\Pages\CreateVehicleType;
use App\Filament\Vehicle\Resources\VehicleTypes\Pages\EditVehicleType;
use App\Filament\Vehicle\Resources\VehicleTypes\Pages\ListVehicleTypes;
use App\Filament\Vehicle\Resources\VehicleTypes\Pages\ViewVehicleType;
use App\Filament\Vehicle\Resources\VehicleTypes\Schemas\VehicleTypeForm;
use App\Filament\Vehicle\Resources\VehicleTypes\Schemas\VehicleTypeInfolist;
use App\Filament\Vehicle\Resources\VehicleTypes\Tables\VehicleTypesTable;
use App\Models\Vehicle\VehicleType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleTypeResource extends Resource
{
    protected static ?string $model = VehicleType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return VehicleTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VehicleTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VehicleTypesTable::configure($table);
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
            'index' => ListVehicleTypes::route('/'),
            'create' => CreateVehicleType::route('/create'),
            'view' => ViewVehicleType::route('/{record}'),
            'edit' => EditVehicleType::route('/{record}/edit'),
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
