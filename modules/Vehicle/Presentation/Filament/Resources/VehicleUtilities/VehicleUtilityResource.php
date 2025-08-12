<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleUtilities;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleUtility;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleUtilities\Pages\CreateVehicleUtility;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleUtilities\Pages\EditVehicleUtility;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleUtilities\Pages\ListVehicleUtilities;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleUtilities\Pages\ViewVehicleUtility;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleUtilities\Schemas\VehicleUtilityForm;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleUtilities\Schemas\VehicleUtilityInfolist;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleUtilities\Tables\VehicleUtilitiesTable;

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
