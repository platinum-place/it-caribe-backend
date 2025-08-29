<?php

namespace App\Filament\Resources\Vehicle\VehicleModels;

use App\Filament\Resources\Vehicle\VehicleModels\Pages\CreateVehicleModel;
use App\Filament\Resources\Vehicle\VehicleModels\Pages\EditVehicleModel;
use App\Filament\Resources\Vehicle\VehicleModels\Pages\ListVehicleModels;
use App\Filament\Resources\Vehicle\VehicleModels\Pages\ViewVehicleModel;
use App\Filament\Resources\Vehicle\VehicleModels\Schemas\VehicleModelForm;
use App\Filament\Resources\Vehicle\VehicleModels\Schemas\VehicleModelInfolist;
use App\Filament\Resources\Vehicle\VehicleModels\Tables\VehicleModelsTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Vehicle\Models\VehicleModel;

class VehicleModelResource extends Resource
{
    protected static ?string $model = VehicleModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): ?string
    {
        return __('Vehicle');
    }

    public static function form(Schema $schema): Schema
    {
        return VehicleModelForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VehicleModelInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VehicleModelsTable::configure($table);
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
            'index' => ListVehicleModels::route('/'),
            'create' => CreateVehicleModel::route('/create'),
            'view' => ViewVehicleModel::route('/{record}'),
            'edit' => EditVehicleModel::route('/{record}/edit'),
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
