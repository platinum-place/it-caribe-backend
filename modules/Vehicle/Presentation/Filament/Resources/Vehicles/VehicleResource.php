<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\Vehicles;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Vehicle\Infrastructure\Persistence\Models\Vehicle;
use Modules\Vehicle\Presentation\Filament\Resources\Vehicles\Pages\CreateVehicle;
use Modules\Vehicle\Presentation\Filament\Resources\Vehicles\Pages\EditVehicle;
use Modules\Vehicle\Presentation\Filament\Resources\Vehicles\Pages\ListVehicles;
use Modules\Vehicle\Presentation\Filament\Resources\Vehicles\Pages\ViewVehicle;
use Modules\Vehicle\Presentation\Filament\Resources\Vehicles\Schemas\VehicleForm;
use Modules\Vehicle\Presentation\Filament\Resources\Vehicles\Schemas\VehicleInfolist;
use Modules\Vehicle\Presentation\Filament\Resources\Vehicles\Tables\VehiclesTable;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'chassis';

    public static function form(Schema $schema): Schema
    {
        return VehicleForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VehicleInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VehiclesTable::configure($table);
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
            'index' => ListVehicles::route('/'),
            'create' => CreateVehicle::route('/create'),
            'view' => ViewVehicle::route('/{record}'),
            'edit' => EditVehicle::route('/{record}/edit'),
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
