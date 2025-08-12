<?php

namespace Modules\Vehicle\Presentation\Filament\Resources\VehicleUses;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Vehicle\Infrastructure\Persistence\Models\VehicleUse;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleUses\Pages\CreateVehicleUse;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleUses\Pages\EditVehicleUse;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleUses\Pages\ListVehicleUses;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleUses\Pages\ViewVehicleUse;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleUses\Schemas\VehicleUseForm;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleUses\Schemas\VehicleUseInfolist;
use Modules\Vehicle\Presentation\Filament\Resources\VehicleUses\Tables\VehicleUsesTable;

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
