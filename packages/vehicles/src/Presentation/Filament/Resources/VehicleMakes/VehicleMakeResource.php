<?php

namespace App\Filament\Resources\Vehicle\VehicleMakes;

use App\Filament\Resources\Vehicle\VehicleMakes\Schemas\VehicleMakeForm;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use old\Modules\Vehicle\app\Models\VehicleMake;
use old\Filament\Resources\Vehicle\VehicleMakes\Pages\CreateVehicleMake;
use old\Filament\Resources\Vehicle\VehicleMakes\Pages\EditVehicleMake;
use old\Filament\Resources\Vehicle\VehicleMakes\Pages\ListVehicleMakes;
use old\Filament\Resources\Vehicle\VehicleMakes\Pages\ViewVehicleMake;
use old\Filament\Resources\Vehicle\VehicleMakes\Schemas\VehicleMakeInfolist;
use old\Filament\Resources\Vehicle\VehicleMakes\Tables\VehicleMakesTable;

class VehicleMakeResource extends Resource
{
    protected static ?string $model = VehicleMake::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): ?string
    {
        return __('Vehicle');
    }

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
