<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleTypes;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleType;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleTypes\Pages\CreateVehicleType;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleTypes\Pages\EditVehicleType;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleTypes\Pages\ListVehicleTypes;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleTypes\Pages\ViewVehicleType;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleTypes\Schemas\VehicleTypeForm;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleTypes\Schemas\VehicleTypeInfolist;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleTypes\Tables\VehicleTypesTable;

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
