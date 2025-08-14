<?php

namespace App\Filament\Resources\VehicleActivities;

use App\Filament\Resources\VehicleActivities\Pages\CreateVehicleActivity;
use App\Filament\Resources\VehicleActivities\Pages\EditVehicleActivity;
use App\Filament\Resources\VehicleActivities\Pages\ListVehicleActivities;
use App\Filament\Resources\VehicleActivities\Pages\ViewVehicleActivity;
use App\Filament\Resources\VehicleActivities\Schemas\VehicleActivityForm;
use App\Filament\Resources\VehicleActivities\Schemas\VehicleActivityInfolist;
use App\Filament\Resources\VehicleActivities\Tables\VehicleActivitiesTable;
use App\Models\Vehicle\VehicleActivity;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleActivityResource extends Resource
{
    protected static ?string $model = VehicleActivity::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return VehicleActivityForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VehicleActivityInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VehicleActivitiesTable::configure($table);
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
            'index' => ListVehicleActivities::route('/'),
            'create' => CreateVehicleActivity::route('/create'),
            'view' => ViewVehicleActivity::route('/{record}'),
            'edit' => EditVehicleActivity::route('/{record}/edit'),
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
