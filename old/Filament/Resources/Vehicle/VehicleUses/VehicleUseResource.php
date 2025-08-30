<?php

namespace App\Filament\Resources\Vehicle\VehicleUses;

use App\Filament\Resources\Vehicle\VehicleUses\Pages\CreateVehicleUse;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Vehicle\Models\VehicleUse;
use old\Filament\Resources\Vehicle\VehicleUses\Pages\EditVehicleUse;
use old\Filament\Resources\Vehicle\VehicleUses\Pages\ListVehicleUses;
use old\Filament\Resources\Vehicle\VehicleUses\Pages\ViewVehicleUse;
use old\Filament\Resources\Vehicle\VehicleUses\Schemas\VehicleUseForm;
use old\Filament\Resources\Vehicle\VehicleUses\Schemas\VehicleUseInfolist;
use old\Filament\Resources\Vehicle\VehicleUses\Tables\VehicleUsesTable;

class VehicleUseResource extends Resource
{
    protected static ?string $model = VehicleUse::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationGroup(): ?string
    {
        return __('Vehicle');
    }

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
