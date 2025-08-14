<?php

namespace App\Filament\Vehicle\Resources\VehicleUses;

use App\Filament\Vehicle\Resources\VehicleUses\Pages\CreateVehicleUse;
use App\Filament\Vehicle\Resources\VehicleUses\Pages\EditVehicleUse;
use App\Filament\Vehicle\Resources\VehicleUses\Pages\ListVehicleUses;
use App\Filament\Vehicle\Resources\VehicleUses\Pages\ViewVehicleUse;
use App\Filament\Vehicle\Resources\VehicleUses\Schemas\VehicleUseForm;
use App\Filament\Vehicle\Resources\VehicleUses\Schemas\VehicleUseInfolist;
use App\Filament\Vehicle\Resources\VehicleUses\Tables\VehicleUsesTable;
use App\Models\Vehicle\VehicleUse;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VehicleUseResource extends Resource
{
    protected static ?string $model = VehicleUse::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return VehicleUseForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VehicleUseInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VehicleUsesTable::configure($table);
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
            'index' => ListVehicleUses::route('/'),
            'create' => CreateVehicleUse::route('/create'),
            'view' => ViewVehicleUse::route('/{record}'),
            'edit' => EditVehicleUse::route('/{record}/edit'),
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
