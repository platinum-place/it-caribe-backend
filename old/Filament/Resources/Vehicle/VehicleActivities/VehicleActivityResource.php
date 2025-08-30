<?php

namespace App\Filament\Resources\Vehicle\VehicleActivities;

use old\Filament\Resources\Vehicle\VehicleActivities\Pages\CreateVehicleActivity;
use old\Filament\Resources\Vehicle\VehicleActivities\Pages\EditVehicleActivity;
use old\Filament\Resources\Vehicle\VehicleActivities\Pages\ListVehicleActivities;
use old\Filament\Resources\Vehicle\VehicleActivities\Pages\ViewVehicleActivity;
use old\Filament\Resources\Vehicle\VehicleActivities\Schemas\VehicleActivityForm;
use old\Filament\Resources\Vehicle\VehicleActivities\Schemas\VehicleActivityInfolist;
use old\Filament\Resources\Vehicle\VehicleActivities\Tables\VehicleActivitiesTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Vehicle\Models\VehicleActivity;

class VehicleActivityResource extends Resource
{
    protected static ?string $model = VehicleActivity::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): ?string
    {
        return __('Vehicle');
    }

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
