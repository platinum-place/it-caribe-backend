<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleActivities;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleActivity;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleActivities\Pages\CreateVehicleActivity;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleActivities\Pages\EditVehicleActivity;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleActivities\Pages\ListVehicleActivities;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleActivities\Pages\ViewVehicleActivity;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleActivities\Schemas\VehicleActivityForm;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleActivities\Schemas\VehicleActivityInfolist;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleActivities\Tables\VehicleActivitiesTable;

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
