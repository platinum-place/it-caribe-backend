<?php

namespace App\Filament\Resources\Vehicle\VehicleUtilities;

use App\Filament\Resources\Vehicle\VehicleUtilities\Pages\EditVehicleUtility;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Vehicle\Models\VehicleUtility;
use old\Filament\Resources\Vehicle\VehicleUtilities\Pages\CreateVehicleUtility;
use old\Filament\Resources\Vehicle\VehicleUtilities\Pages\ListVehicleUtilities;
use old\Filament\Resources\Vehicle\VehicleUtilities\Pages\ViewVehicleUtility;
use old\Filament\Resources\Vehicle\VehicleUtilities\Schemas\VehicleUtilityForm;
use old\Filament\Resources\Vehicle\VehicleUtilities\Schemas\VehicleUtilityInfolist;
use old\Filament\Resources\Vehicle\VehicleUtilities\Tables\VehicleUtilitiesTable;

class VehicleUtilityResource extends Resource
{
    protected static ?string $model = VehicleUtility::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): ?string
    {
        return __('Vehicle');
    }

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
