<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleModels;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleModel;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleModels\Pages\CreateVehicleModel;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleModels\Pages\EditVehicleModel;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleModels\Pages\ListVehicleModels;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleModels\Pages\ViewVehicleModel;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleModels\Schemas\VehicleModelForm;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleModels\Schemas\VehicleModelInfolist;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleModels\Tables\VehicleModelsTable;

class VehicleModelResource extends Resource
{
    protected static ?string $model = VehicleModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

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
