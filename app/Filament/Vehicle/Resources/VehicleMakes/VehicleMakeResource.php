<?php

namespace App\Filament\Vehicle\Resources\VehicleMakes;

use App\Filament\Vehicle\Resources\VehicleMakes\Pages\CreateVehicleMake;
use App\Filament\Vehicle\Resources\VehicleMakes\Pages\EditVehicleMake;
use App\Filament\Vehicle\Resources\VehicleMakes\Pages\ListVehicleMakes;
use App\Filament\Vehicle\Resources\VehicleMakes\Pages\ViewVehicleMake;
use App\Filament\Vehicle\Resources\VehicleMakes\Schemas\VehicleMakeForm;
use App\Filament\Vehicle\Resources\VehicleMakes\Schemas\VehicleMakeInfolist;
use App\Filament\Vehicle\Resources\VehicleMakes\Tables\VehicleMakesTable;
use App\Models\Vehicle\VehicleMake;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleMakeResource extends Resource
{
    protected static ?string $model = VehicleMake::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return VehicleMakeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VehicleMakeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VehicleMakesTable::configure($table);
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
            'index' => ListVehicleMakes::route('/'),
            'create' => CreateVehicleMake::route('/create'),
            'view' => ViewVehicleMake::route('/{record}'),
            'edit' => EditVehicleMake::route('/{record}/edit'),
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
