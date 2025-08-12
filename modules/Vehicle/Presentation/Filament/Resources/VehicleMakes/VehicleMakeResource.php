<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleMakes;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleMake;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleMakes\Pages\CreateVehicleMake;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleMakes\Pages\EditVehicleMake;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleMakes\Pages\ListVehicleMakes;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleMakes\Pages\ViewVehicleMake;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleMakes\Schemas\VehicleMakeForm;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleMakes\Schemas\VehicleMakeInfolist;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleMakes\Tables\VehicleMakesTable;

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
