<?php

namespace App\Filament\Resources\VehicleUtilities;

use App\Filament\Resources\VehicleUtilities\Pages\CreateVehicleUtility;
use App\Filament\Resources\VehicleUtilities\Pages\EditVehicleUtility;
use App\Filament\Resources\VehicleUtilities\Pages\ListVehicleUtilities;
use App\Filament\Resources\VehicleUtilities\Pages\ViewVehicleUtility;
use App\Filament\Resources\VehicleUtilities\Schemas\VehicleUtilityForm;
use App\Filament\Resources\VehicleUtilities\Schemas\VehicleUtilityInfolist;
use App\Filament\Resources\VehicleUtilities\Tables\VehicleUtilitiesTable;
use App\Models\Vehicle\VehicleUtility;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleUtilityResource extends Resource
{
    protected static ?string $model = VehicleUtility::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return VehicleUtilityForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VehicleUtilityInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VehicleUtilitiesTable::configure($table);
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
            'index' => ListVehicleUtilities::route('/'),
            'create' => CreateVehicleUtility::route('/create'),
            'view' => ViewVehicleUtility::route('/{record}'),
            'edit' => EditVehicleUtility::route('/{record}/edit'),
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
